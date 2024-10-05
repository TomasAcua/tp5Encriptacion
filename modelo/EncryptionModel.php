<?php

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;

class EncryptionModel {

    private $uploadDir;
    private $keyDir;

    public function __construct() {
        $this->uploadDir =realpath( __DIR__ . '/../uploads/'). '/';
        $this->keyDir = __DIR__ . '/../keys/';
    }

    public function uploadFile($file) {
        $filePath = $this->uploadDir . basename($file['name']);
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            return $filePath;
        }
        return false;
    }

    public function encryptFile($filePath) {
        try {
            $key = Key::createNewRandomKey();
            $fileContents = file_get_contents($filePath);
            $ciphertext = Crypto::encrypt($fileContents, $key);
            file_put_contents($filePath . '.encrypted', $ciphertext);

            $keyPath = $this->keyDir . basename($filePath) . '.key';
            file_put_contents($keyPath, $key->saveToAsciiSafeString());

            return ['file' => $filePath . '.encrypted', 'key' => $keyPath];
        } catch (Exception $e) {
            return ['error' => 'Error al encriptar el archivo: ' . $e->getMessage()];
        }
    }

    public function encryptText($text) {
        try {
            $key = Key::createNewRandomKey();
            $ciphertext = Crypto::encrypt($text, $key);

            $keyPath = $this->keyDir . 'text_' . time() . '.key';
            file_put_contents($keyPath, $key->saveToAsciiSafeString());

            return ['ciphertext' => $ciphertext, 'key' => $keyPath];
        } catch (Exception $e) {
            return ['error' => 'Error al encriptar el texto: ' . $e->getMessage()];
        }
    }

    public function decryptFile($filePath, $keyText) {
        // Leer el contenido cifrado del archivo
        $ciphertext = file_get_contents($filePath);
        $key = Key::loadFromAsciiSafeString($keyText);  // Cargar la clave desde el texto
        $plaintext = Crypto::decrypt($ciphertext, $key);  // Desencriptar el contenido
    
        // Obtener el nombre original del archivo incluyendo su extensión
        $originalFileName = pathinfo($filePath, PATHINFO_FILENAME);  // Nombre sin la extensión .encrypted
        $originalExtension = pathinfo($filePath, PATHINFO_EXTENSION);  // Extensión original del archivo
        $decryptedFilePath = '../uploads/' . $originalFileName; // Ruta del archivo desencriptado
    
        // Si el archivo tiene una extensión, preservarla
        if ($originalExtension !== 'encrypted') {
            $decryptedFilePath .= '.' . $originalExtension;
        }
    
        // Asegurarse de que la carpeta uploads existe y tiene permisos de escritura
        if (!is_dir('../uploads/')) {
            mkdir('../uploads/', 0777, true);
        }
    
        // Guardar el archivo desencriptado en la ruta correcta
        file_put_contents($decryptedFilePath, $plaintext);
    
        return ['file' => $decryptedFilePath];
    }
    
    

    public function decryptText($ciphertext, $keyText) {
        $key = Key::loadFromAsciiSafeString($keyText);  // Cargar la clave desde el texto
        $plaintext = Crypto::decrypt($ciphertext, $key);
        return ['plaintext' => $plaintext];
    }
}
