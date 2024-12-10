<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Árboles de <?= esc($amigo['nombre']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)),
            url('https://www.arenalobservatorylodge.com/wp-content/uploads/2023/01/Volcan-Arenal-4.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        color: #e0e0e0;
        min-height: 100vh;
    }

    .container {
        padding-top: 2rem;
        padding-bottom: 2rem;
    }

    .card {
        background: rgba(45, 45, 45, 0.85);
        backdrop-filter: blur(10px);
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
        transition: transform 0.3s ease;
        animation: fadeIn 0.5s ease-out;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .table {
        color: #ffffff;
        margin-bottom: 0;
    }

    .table th {
        background-color: rgba(61, 61, 61, 0.7);
        border-color: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        font-weight: 600;
    }

    .table td {
        color: #ffffff !important;
        border-color: rgba(255, 255, 255, 0.1);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(92, 107, 192, 0.1);
        color: #ffffff !important;
    }

    .table-hover tbody tr:hover td {
        color: #ffffff !important;
    }

    .btn-primary {
        background-color: rgba(92, 107, 192, 0.9);
        border-color: transparent;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .btn-primary:hover {
        background-color: rgba(63, 81, 181, 0.95);
        border-color: transparent;
        transform: translateY(-2px);
    }

    .btn-danger {
        background-color: rgba(220, 53, 69, 0.9);
        border-color: transparent;
        transition: all 0.3s ease;
    }

    .btn-danger:hover {
        background-color: rgba(200, 35, 51, 0.95);
        transform: translateY(-2px);
    }

    .alert {
        border-radius: 10px;
        border: none;
    }

    .alert-success {
        background-color: rgba(28, 74, 28, 0.9);
        border-color: rgba(39, 105, 39, 0.5);
        color: #9aff9a;
    }

    .alert-danger {
        background-color: rgba(74, 28, 28, 0.9);
        border-color: rgba(105, 39, 39, 0.5);
        color: #ff9a9a;
    }

    .page-header {
        background: rgba(45, 45, 45, 0.85);
        backdrop-filter: blur(10px);
        padding: 1.5rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
    }

    .page-header h2 {
        color: #ffffff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        margin: 0;
    }

    .table-responsive {
        border-radius: 10px;
        overflow: hidden;
    }

    .bi {
        margin-right: 0.25rem;
    }

    .btn-info {
        background-color: rgba(23, 162, 184, 0.9);
        border-color: transparent;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-info:hover {
        background-color: rgba(19, 132, 150, 0.95);
        border-color: transparent;
        color: white;
        transform: translateY(-2px);
    }

    .navbar {
        background: rgba(45, 45, 45, 0.9) !important;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
    }

    .navbar-brand,
    .nav-link {
        color: #ffffff !important;
    }

    .nav-link:hover {
        color: #a5aeff !important;
    }

    .dropdown-menu {
        background: rgba(45, 45, 45, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .dropdown-item {
        color: #ffffff;
    }

    .dropdown-item:hover {
        background: rgba(92, 107, 192, 0.2);
        color: #a5aeff;
    }
    </style>
</head>

<body>
    <div class="page-overlay"></div>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url($baseRoute . '/dashboard') ?>">
                <i class="bi bi-tree"></i> Un Millón de Árboles
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url($baseRoute . '/dashboard') ?>">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <?php if($isAdmin): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url($baseRoute . '/especies') ?>">
                            <i class="bi bi-tree"></i> Especies
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url($baseRoute . '/arboles') ?>">
                            <i class="bi bi-flower1"></i> Árboles
                        </a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url($baseRoute . '/amigos') ?>">
                            <i class="bi bi-people"></i> Amigos
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> <?= session()->get('nombre') ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('logout') ?>">
                                    <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                                </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="buttons-container">
                    <h2>Árboles de <?= esc($amigo['nombre']) ?></h2>
                </div>
                <a href="<?= base_url($baseRoute . '/amigos') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Especie</th>
                                <th>Ubicación</th>
                                <th>Estado</th>
                                <th>Tamaño</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($arboles)): ?>
                            <?php foreach ($arboles as $arbol): ?>
                            <tr>
                                <td><?= esc($arbol['nombre_comercial']) ?></td>
                                <td><?= esc($arbol['ubicacion_geografica']) ?></td>
                                <td><?= esc($arbol['estado']) ?></td>
                                <td><?= esc($arbol['tamanio']) ?> m</td>
                                <td>
                                    <?php if($isAdmin): ?>
                                    <a href="<?= base_url($baseRoute . '/arboles/edit/'.$arbol['id'].'?from=amigos&usuario_id='.$amigo['id']) ?>"
                                        class="btn btn-primary btn-sm me-1">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <?php endif; ?>

                                    <a href="<?= base_url($baseRoute . '/amigos/actualizar-arbol/'.$arbol['id']) ?>"
                                        class="btn btn-info btn-sm me-1">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </a>
                                    <a href="<?= base_url($baseRoute . '/amigos/historial/'.$arbol['id']) ?>"
                                        class="btn btn-secondary btn-sm">
                                        <i class="bi bi-clock-history"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No hay árboles registrados para este amigo.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>