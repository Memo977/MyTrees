<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso No Autorizado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="<?= base_url('assets/css/modules/_unauthorized.css') ?>" rel="stylesheet">
</head>

<body>
    <div class="page-overlay"></div>
    <div class="card text-center">
        <div class="card-body">
            <i class="bi bi-exclamation-triangle-fill error-icon"></i>
            <h1>Acceso No Autorizado</h1>
            <p>No tienes permisos para acceder a esta sección. Por favor, contacta al administrador si crees que esto es
                un error.</p>
            <a href="<?= base_url('login') ?>" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Volver al Inicio
            </a>
        </div>
    </div>
</body>

</html>