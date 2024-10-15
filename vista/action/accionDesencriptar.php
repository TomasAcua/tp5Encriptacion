<?php
require_once '../../control/EncryptionController.php';
require_once '../../util/configuracion.php';

$encryptionController = new EncryptionController($_SESSION['db']);
$datos = darDatosSubmitted();

// Obtener los datos enviados
$claveTexto = $datos['key'];  // Clave en texto
$fileId = $datos['fileId'] ?? null;  // ID del archivo encriptado (opcional)

$resultado = null;

// Si se proporcionó un ID de archivo encriptado
if ($fileId) {
    $resultado = $encryptionController->decryptFile($fileId, $claveTexto);
}

if (isset($resultado['error'])) {
    $mensaje = $resultado['error'];
} else {
    $archivoDesencriptado = $resultado['file'];
    $textoDesencriptado = $resultado['plaintext'] ?? null;
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
        <?php if ($archivoDesencriptado): ?>
            <p>Archivo desencriptado: <a href="descargar.php?file=<?= $fileId ?>" download>Descargar</a></p>
        <?php elseif ($textoDesencriptado): ?>
            <p>Texto desencriptado:</p>
            <textarea class="form-control" id="textoDesencriptado" readonly><?= $textoDesencriptado ?></textarea>
            <button class="btn btn-primary mt-3" onclick="copiarTexto()">Copiar Texto</button>
        <?php endif; ?>
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
