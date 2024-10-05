<?php
require_once '../../control/EncryptionController.php';
require_once '../../util/configuracion.php';

$encryptionController = new EncryptionController();
$datos = darDatosSubmitted();

$resultado = $encryptionController->encryptFileOrText($_FILES + $datos);

if (isset($resultado['error'])) {
    $mensaje = $resultado['error'];
} else {
    $archivoEncriptado = $resultado['file'] ?? null;
    $textoEncriptado = $resultado['ciphertext'] ?? null;
    $rutaClave = $resultado['key']; // Ruta absoluta de la clave
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
        <?php if ($archivoEncriptado): ?>
            <!-- Aquí pasamos el nombre del archivo -->
            <form action="../descargar.php" method="POST">
                <input type="hidden" name="file" value="<?= basename($archivoEncriptado) ?>">
                <button type="submit" class="btn btn-primary">Descargar Archivo Encriptado</button>
            </form>
        <?php elseif ($textoEncriptado): ?>
            <p>Texto encriptado: <textarea class="form-control" readonly><?= $textoEncriptado ?></textarea></p>
        <?php endif; ?>
        <p>Clave de encriptación:</p>
        <textarea class="form-control" id="key" readonly><?= file_get_contents($rutaClave) ?></textarea>
        <button class="btn btn-primary mt-3" onclick="copiarClave()">Copiar Clave</button>
    <?php endif; ?>
    <a href="../encriptar.php" class="btn btn-secondary mt-3">Volver</a>
    <a href="../../index.php" class="btn btn-secondary mt-3">Volver al Menú</a>
</div>

<script src="../js/validaciones.js"></script>
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
