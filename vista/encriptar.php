<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encriptar Archivo o Texto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
<?php include '../vista/estructura/header.php'; ?>
    <div class="container mt-5">
        <h1>Encriptar Archivo o Texto</h1>
        <form action="action/accionEncriptar.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="file" class="form-label">Seleccionar archivo</label>
                <input type="file" class="form-control" id="file" name="file">
            </div>
            <div class="mb-3">
                <label for="text" class="form-label">O introduce un texto para encriptar</label>
                <textarea class="form-control" id="text" name="text"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-animate">Encriptar</button>
        </form>
        <a href="../index.php" class="btn btn-secondary mt-3 btn-animate">Volver al Menú</a>
    </div>
<?php include '../vista/estructura/footer.php'; ?>
    <script src="../js/validaciones.js"></script>
</body>
</html>
