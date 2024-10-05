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
        <h1>Desencriptar Archivo o Texto</h1>
        <form action="action/accionDesencriptar.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="key" class="form-label">Clave de Desencriptación (Texto)</label>
                <textarea class="form-control" id="key" name="key" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Archivo Encriptado (opcional)</label>
                <input type="file" class="form-control" id="file" name="file">
            </div>
            <div class="mb-3">
                <label for="ciphertext" class="form-label">Texto Encriptado (opcional)</label>
                <textarea class="form-control" id="ciphertext" name="ciphertext" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-animate">Desencriptar</button>
        </form>
        <a href="../index.php" class="btn btn-secondary mt-3 btn-animate">Volver al Menú</a>
    </div>
    <?php include '../vista/estructura/footer.php'; ?>
    <script src="../js/validaciones.js"></script>
</body>
</html>
