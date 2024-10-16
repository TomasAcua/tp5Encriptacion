<?php
require_once '../../control/EncryptionController.php';
require_once '../../util/configuracion.php';

$encryptionController = new EncryptionController($db);
$datos = darDatosSubmitted();

// Obtener los datos enviados
$claveTexto = $datos['key'];  // Clave en texto
$fileId = intval($datos['fileId']);  // ID del archivo encriptado

$resultado = $encryptionController->decryptFile($fileId, $claveTexto);

// Si ocurre un error, mostrar el mensaje
if (isset($resultado['error'])) {
    $mensaje = $resultado['error'];
} else {
    // El archivo será descargado directamente desde el modelo
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Desencriptación</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Resultado de Desencriptación</h1>
    <?php if (isset($mensaje)): ?>
        <p class="error-message"><?= $mensaje ?></p>
    <?php else: ?>
        <p>Archivo desencriptado:</p>
        <textarea class="form-control" id="textoDesencriptado" readonly><?= $textoDesencriptado ?></textarea>
        <button class="btn btn-primary mt-3" onclick="copiarTexto()">Copiar Texto</button>
    <?php endif; ?>
    <a href="../desencriptar.php" class="btn btn-secondary mt-3">Volver</a>
</div>

<script>
    function copiarTexto() {
        var textoTextarea = document.getElementById('textoDesencriptado');
        textoTextarea.select();
        document.execCommand('copy');
        alert('Texto copiado al portapapeles');
    }
</script>
</body>
</html>
