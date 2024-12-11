<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página No Encontrada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="<?= base_url('assets/css/404.css') ?>" rel="stylesheet">
</head>

<body>
    <div class="page-overlay"></div>
    <div class="card text-center">
        <div class="card-body">
            <i class="bi bi-compass error-icon"></i>
            <p class="error-code">404</p>
            <h1>Página No Encontrada</h1>
            <p>La página que estás buscando no existe o ha sido movida. ¿Te gustaría volver al inicio?</p>
            <?php
            // Determinar la ruta de retorno según el rol del usuario
            $returnPath = 'login';
            if (session()->get('isLoggedIn')) {
                $rol_id = session()->get('rol_id');
                $returnPath = $rol_id == 1 ? 'admin/dashboard' : 
                            ($rol_id == 2 ? 'operador/dashboard' : 
                            'amigo/dashboard');
            }
            ?>
            <a href="<?= base_url($returnPath) ?>" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Volver al Inicio
            </a>
        </div>
    </div>
</body>

</html>