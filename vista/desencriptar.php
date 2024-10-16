<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desencriptar</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../vista/estructura/header.php'; ?>
    <div class="container mt-5">
        <h1>Desencriptar Archivo</h1>
        <form action="action/accionDesencriptar.php" method="POST">
            <div class="mb-3">
                <label for="fileId" class="form-label">ID del Archivo Encriptado</label>
                <input type="text" class="form-control" id="fileId" name="fileId" required>
            </div>
            <div class="mb-3">
                <label for="key" class="form-label">Clave de Desencriptación (Texto)</label>
                <textarea class="form-control" id="key" name="key" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-animate">Desencriptar y Descargar</button>
        </form>
        <a href="../index.php" class="btn btn-secondary mt-3">Volver al Menú</a>
    </div>
    <?php include '../vista/estructura/footer.php'; ?>
</body>
</html>
