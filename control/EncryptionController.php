<?php
require_once __DIR__ . '/../modelo/EncryptionModel.php';


class EncryptionController {
    private $model;

    public function __construct() {
        $this->model = new EncryptionModel();
    }

    public function encryptFileOrText($data) {
        if (isset($data['file']) && $data['file']['size'] > 0) {
            // Encriptar archivo
            $filePath = $this->model->uploadFile($data['file']);
            if ($filePath) {
                $result = $this->model->encryptFile($filePath);
                return $result;
            }
        } elseif (!empty($data['text'])) {
            // Encriptar texto
            return $this->model->encryptText($data['text']);
        }
        return ['error' => 'Por favor, sube un archivo o introduce un texto.'];
    }

    public function decryptFile($filePath, $keyText) {
        return $this->model->decryptFile($filePath, $keyText);
    }

    public function decryptText($ciphertext, $keyText) {
        return $this->model->decryptText($ciphertext, $keyText);
    }
}
?>
