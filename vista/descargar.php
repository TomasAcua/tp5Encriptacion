<?php
require_once '../util/configuracion.php';

if (isset($_GET['file'])) {
    $fileId = intval($_GET['file']);

    // Obtener el archivo de la base de datos
    $stmt = $db->prepare("SELECT file_name, encrypted_file FROM encrypted_files WHERE id = :id");
    $stmt->bindParam(':id', $fileId);
    $stmt->execute();
    $fileData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($fileData) {
        // Preparar encabezados HTTP para la descarga del archivo
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($fileData['file_name']) . '.encrypted"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . strlen($fileData['encrypted_file']));

        // Enviar el archivo encriptado al usuario para su descarga
        echo $fileData['encrypted_file'];
        exit;
    } else {
        echo "Error: Archivo no encontrado." . htmlspecialchars($fileId);
    }
} else {
    echo "Error: Parámetro 'file' no especificado.";
}
