<?php
// Archivo de configuración global del proyecto

session_start();

$PROYECTO = 'tp5Encriptacion';
$ROOT = $_SERVER['DOCUMENT_ROOT'] . "/$PROYECTO/";

// Conexión a la base de datos (no la guardamos en la sesión)
try {
    $db = new PDO('mysql:host=localhost;dbname=encryptionDB;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
// Autoload para las clases y dependencias instaladas por Composer
require_once $ROOT . 'vendor/autoload.php';
// Autoload para clases
spl_autoload_register(function ($class_name) use ($ROOT) {
    $directories = [
        $ROOT . 'modelo/',
        $ROOT . 'control/'
    ];

    foreach ($directories as $directory) {
        if (file_exists($directory . $class_name . '.php')) {
            require_once $directory . $class_name . '.php';
            return;
        }
    }
});

// Función para encapsular el envío por POST o GET
function darDatosSubmitted() {
    return $_SERVER["REQUEST_METHOD"] === "POST" ? $_POST : $_GET;
}
