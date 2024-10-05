<?php
// configuracion.php
header('Content-Type: text/html; charset=utf-8');
header("Cache-Control: no-cache, must-revalidate");

$PROYECTO = 'PHPMYSQL';  // Nombre del proyecto

// Directorio del proyecto
$ROOT = $_SERVER['DOCUMENT_ROOT'] . "/$PROYECTO/";

// Cargar autoload de Composer
require_once __DIR__ . '/../vendor/autoload.php';


// Ruta de claves y archivos
$UPLOADS_DIR = $ROOT . 'uploads/';
$KEYS_DIR = $ROOT . 'keys/';

// Verificar si existen los directorios
if (!file_exists($UPLOADS_DIR)) {
    mkdir($UPLOADS_DIR, 0777, true);
}

if (!file_exists($KEYS_DIR)) {
    mkdir($KEYS_DIR, 0777, true);
}

// Función para encapsular el envío por POST o GET
function darDatosSubmitted() {
    return $_SERVER["REQUEST_METHOD"] === "POST" ? $_POST : $_GET;
}

// Cargar claves y archivos de encriptación
function cargarArchivo($campo) {
    if (isset($_FILES[$campo]) && $_FILES[$campo]['size'] > 0) {
        $nombreArchivo = basename($_FILES[$campo]['name']);
        $ruta = $GLOBALS['UPLOADS_DIR'] . $nombreArchivo;
        move_uploaded_file($_FILES[$campo]['tmp_name'], $ruta);
        return $ruta;
    }
    return false;
}

