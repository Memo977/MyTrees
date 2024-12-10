<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Árboles - Sistema de Gestión de Árboles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
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
        max-width: 1200px;
    }

    .card {
        background: rgba(45, 45, 45, 0.85);
        backdrop-filter: blur(10px);
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
        transition: transform 0.3s ease;
        width: 280px;
        margin: 0 auto;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-img-top {
        height: 160px;
        object-fit: cover;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .row {
        justify-content: center;
        gap: 1.5rem;
    }

    .card-body {
        padding: 1rem;
    }

    .card-title {
        color: #ffffff;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }

    .tree-info {
        font-size: 0.85rem;
        color: #e0e0e0;
        margin-bottom: 0.5rem;
    }

    .tree-info i {
        width: 20px;
        color: #adb5bd;
        margin-right: 8px;
    }

    .badge {
        font-size: 0.8rem;
        padding: 0.5em 1em;
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

    .btn-primary {
        background-color: #0d6efd;
        border: none;
        color: white;
        transition: all 0.3s ease;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        font-weight: 500;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
        color: white;
        transform: translateY(-2px);
    }

    .btn-details {
        background-color: #0d6efd;
        color: white;
        border: none;
        padding: 8px 16px;
        font-weight: 500;
        width: 100%;
        display: block;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .btn-details:hover {
        background-color: #0b5ed7;
        color: white;
        transform: translateY(-2px);
        text-decoration: none;
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

    .alert-info {
        background-color: rgba(23, 64, 97, 0.9);
        border-color: rgba(40, 94, 133, 0.5);
        color: #b6d8ef;
    }

    .page-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at center, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.6) 100%);
        pointer-events: none;
        z-index: -1;
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

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card {
        animation: fadeIn 0.5s ease-out;
    }
    </style>
</head>

<body>
    <div class="page-overlay"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url('amigo/dashboard') ?>">
                <i class="bi bi-tree"></i> Un Millón de Árboles
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('amigo/dashboard') ?>">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('amigo/arboles') ?>">
                            <i class="bi bi-tree"></i> Mis Árboles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('amigo/arboles-disponibles') ?>">
                            <i class="bi bi-shop"></i> Comprar
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
                            <li><a class="dropdown-item" href="<?= base_url('amigo/perfil') ?>">
                                    <i class="bi bi-person"></i> Mi Perfil
                                </a></li>
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
                    <h2>Mis Árboles</h2>
                </div>
                <a href="<?= base_url('amigo/dashboard') ?>" class="btn btn-primary">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <?php if (empty($trees)): ?>
        <div class="alert alert-info">
            No tienes árboles registrados todavía.
        </div>
        <?php else: ?>
        <div class="row g-4 justify-content-center">
            <?php foreach ($trees as $tree): ?>
            <div class="col-auto">
                <div class="card">
                    <?php if (!empty($tree['foto_url'])): ?>
                    <img src="<?= base_url('uploads/arboles/' . $tree['foto_url']) ?>" class="card-img-top"
                        alt="Foto de <?= esc($tree['nombre_comercial']) ?>">
                    <?php else: ?>
                    <div class="bg-light text-center py-4">
                        <i class="bi bi-tree-fill text-success" style="font-size: 4rem;"></i>
                    </div>
                    <?php endif; ?>

                    <!-- Estado como badge flotante -->
                    <span class="position-absolute top-2 end-2 mt-2 me-2">
                        <span class="badge" style="background-color: #17a2b8;"><?= esc($tree['estado']) ?></span>
                    </span>

                    <div class="card-body">
                        <h5 class="card-title"><?= esc($tree['nombre_comercial']) ?></h5>
                        <div class="tree-info">
                            <p class="mb-2">
                                <i class="bi bi-rulers"></i>
                                Tamaño actual: <?= esc($tree['tamanio']) ?> metros
                            </p>
                            <p class="mb-2">
                                <i class="bi bi-geo-alt"></i>
                                <?= esc($tree['ubicacion_geografica']) ?>
                            </p>
                            <p class="mb-3">
                                <i class="bi bi-calendar3"></i>
                                Adquirido: <?= date('d/m/Y', strtotime($tree['fecha_venta'])) ?>
                            </p>
                        </div>
                        <a href="<?= base_url('amigo/arboles/detalle/' . $tree['id']) ?>" class="btn-details">
                            <i class="bi bi-eye"></i> Ver Detalles
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>