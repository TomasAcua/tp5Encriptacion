<?php

class EncryptionController {
    private $model;

    public function __construct($db) {
        $this->model = new EncryptionModel($db);
    }

    /**
     * Encriptar un archivo o texto.
     * @param array $data Datos enviados por el formulario.
     * @return array Resultado del proceso de encriptación.
     */
    public function encryptFileOrText($data) {
        if (isset($data['file']) && $data['file']['size'] > 0) {
            // Encriptar archivo
            $filePath = $data['file']['tmp_name'];
            return $this->model->encryptFile($filePath);
        } elseif (!empty($data['text'])) {
            // Encriptar texto (no cubierto en este ejemplo)
            return ['error' => 'Falta implementar la encriptación de texto.'];
        }
        return ['error' => 'Por favor, sube un archivo o introduce un texto.'];
    }

    /**
     * Desencriptar un archivo desde la base de datos.
     * @param int $fileId ID del archivo en la base de datos.
     * @param string $keyText Clave de desencriptación.
     * @return array Resultado del proceso de desencriptación.
     */
    public function decryptFile($fileId, $keyText) {
        return $this->model->decryptFileFromDb($fileId, $keyText);
    }
}
?>
