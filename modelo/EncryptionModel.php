<?php

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;

class EncryptionModel {
    private $db;
    private $uploadDir;
    private $keyDir;

    // Constructor que recibe la conexión a la base de datos
    public function __construct($db) {
        $this->db = $db;
        $this->uploadDir = realpath(__DIR__ . '/../uploads/') . '/';
        $this->keyDir = realpath(__DIR__ . '/../keys/') . '/';
    }

    /**
     * Función para encriptar un archivo y guardarlo en la base de datos.
     * @param string $filePath Ruta del archivo a encriptar.
     * @return array Resultado con el archivo encriptado y la clave.
     */
    public function encryptFile($filePath) {
        try {
            $key = Key::createNewRandomKey();  // Crear una nueva clave aleatoria
            $fileContents = file_get_contents($filePath);
            $ciphertext = Crypto::encrypt($fileContents, $key);  // Encriptar contenido del archivo
            // Guardar el archivo encriptado
            file_put_contents($filePath . '.encrypted', $ciphertext);
            
            // Guardar archivo encriptado en la base de datos
            $stmt = $this->db->prepare("INSERT INTO encrypted_files (file_name, encrypted_file, key_text) VALUES (:file_name, :encrypted_file, :key_text)");
            $stmt->bindParam(':file_name', basename($filePath));
            $stmt->bindParam(':encrypted_file', $ciphertext, PDO::PARAM_LOB);  // Guardar como BLOB
            $stmt->bindParam(':key_text', $key->saveToAsciiSafeString());
            $stmt->execute();

            return ['file' => basename($filePath) . '.encrypted', 'key' => $key->saveToAsciiSafeString()];
        } catch (Exception $e) {
            return ['error' => 'Error al encriptar el archivo: ' . $e->getMessage()];
        }
    }

    /**
     * Obtener archivo encriptado de la base de datos por su ID.
     * @param int $fileId ID del archivo en la base de datos.
     * @return array Datos del archivo.
     */
    public function getEncryptedFile($fileId) {
        $stmt = $this->db->prepare("SELECT * FROM encrypted_files WHERE id = :id");
        $stmt->bindParam(':id', $fileId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Función para desencriptar un archivo usando su ID y clave.
     * @param int $fileId ID del archivo en la base de datos.
     * @param string $keyText Clave de desencriptación.
     * @return array Resultado con el archivo desencriptado.
     */
    public function decryptFileFromDb($fileId, $keyText) {
        $fileData = $this->getEncryptedFile($fileId);
        if (!$fileData) {
            return ['error' => 'Archivo no encontrado'];
        }

        $key = Key::loadFromAsciiSafeString($keyText);  // Cargar clave desde texto
        $plaintext = Crypto::decrypt($fileData['encrypted_file'], $key);  // Desencriptar archivo

        return ['file' => $fileData['file_name'], 'plaintext' => $plaintext];
    }
}

