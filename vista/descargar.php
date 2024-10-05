<?php
if (isset($_POST['file'])) {
    $file = $_POST['file'];
    
    // Ruta completa del archivo dentro de la carpeta uploads
    $filePath = realpath(__DIR__ . '/../uploads/' . basename($file));

    // Verifica si el archivo existe
    if (file_exists($filePath)) {
        // Forzar la descarga del archivo
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } else {
        // Mensaje si el archivo no se encuentra
        echo "El archivo no se encuentra disponible.";
    }
} else {
    echo "No se especificó ningún archivo.";
}
