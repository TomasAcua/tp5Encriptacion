<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'vista/estructura/header.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Menú Principal</h1>
        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <a href="vista/encriptar.php" class="btn btn-primary w-100 btn-animate">Encriptar Archivo o Texto</a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="vista/desencriptar.php" class="btn btn-primary w-100 btn-animate">Desencriptar Archivo o Texto</a>
            </div>
        </div>
    </div>

    <?php include 'vista/estructura/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
