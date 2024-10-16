<?php
require_once '../../control/EncryptionController.php';
require_once '../../util/configuracion.php';

$encryptionController = new EncryptionController($db);
$datos = darDatosSubmitted();

// Procesar encriptación
$resultado = $encryptionController->encryptFileOrText($_FILES + $datos);

if (isset($resultado['error'])) {
    $mensaje = $resultado['error'];
} else {
    $fileId = $db->lastInsertId();  // Obtener el ID del archivo recién encriptado
    $Clave = $resultado['key'];  // Clave de encriptación
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Encriptación</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Resultado de Encriptación</h1>
    <?php if (isset($mensaje)): ?>
        <p class="error-message"><?= $mensaje ?></p>
    <?php else: ?>
        <p>Archivo encriptado con ID: <?= $fileId ?></p>
        <p>Clave de encriptación:</p>
        <textarea class="form-control" id="key" readonly><?= $Clave ?></textarea>
        <button class="btn btn-primary mt-3" onclick="copiarClave()">Copiar Clave</button>
    <?php endif; ?>
    <a href="../encriptar.php" class="btn btn-secondary mt-3">Volver</a>
</div>

<script>
    function copiarClave() {
        var keyTextarea = document.getElementById('key');
        keyTextarea.select();
        document.execCommand('copy');
        alert('Clave copiada al portapapeles');
    }
</script>
</body>
</html>
