<?php
require_once '../../control/EncryptionController.php';
require_once '../../util/configuracion.php';

$encryptionController = new EncryptionController();
$datos = darDatosSubmitted();

// Obtener los datos enviados
$claveTexto = $datos['key'] ?? null;  // Clave en texto
$archivoEncriptado = $_FILES['file']['tmp_name'] ?? null;  // Archivo encriptado (opcional)
$textoEncriptado = $datos['ciphertext'] ?? null;  // Texto encriptado (opcional)

$resultado = null;
$mensaje = null;

// Si hay un archivo encriptado
if ($archivoEncriptado && is_uploaded_file($archivoEncriptado)) {
    // Mover el archivo a una ubicación fija en 'uploads'
    $uploadDir = realpath(__DIR__ . '/../../uploads/') . '/';
    $nombreArchivo = basename($_FILES['file']['name']);
    $archivoDestino = $uploadDir . $nombreArchivo;

    if (move_uploaded_file($archivoEncriptado, $archivoDestino)) {
        // Ahora se puede usar el archivo movido para desencriptar
        $resultado = $encryptionController->decryptFile($archivoDestino, $claveTexto);
    } else {
        $mensaje = "Error al mover el archivo subido.";
    }
}
// Si se ingresó texto encriptado
elseif ($textoEncriptado) {
    $resultado = $encryptionController->decryptText($textoEncriptado, $claveTexto);
}

if (isset($resultado['error'])) {
    $mensaje = $resultado['error'];
} else {
    $textoDesencriptado = $resultado['plaintext'] ?? null;
    $archivoDesencriptado = $resultado['file'] ?? null;
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
        <p class="error-message text-danger"><?= $mensaje ?></p>
    <?php else: ?>
        <?php if ($archivoDesencriptado): ?>
            <p>Archivo desencriptado: <a href="../uploads/<?= basename($archivoDesencriptado) ?>" download>Descargar</a></p>
        <?php elseif ($textoDesencriptado): ?>
            <p>Texto desencriptado:</p>
            <textarea class="form-control" id="textoDesencriptado" rows="6" readonly><?= $textoDesencriptado ?></textarea>
            <button class="btn btn-primary mt-3" onclick="copiarTexto()">Copiar Texto</button>
        <?php endif; ?>
    <?php endif; ?>
    <a href="../desencriptar.php" class="btn btn-secondary mt-3">Volver</a>
    <a href="../../index.php" class="btn btn-secondary mt-3">Volver al Menú</a>
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
