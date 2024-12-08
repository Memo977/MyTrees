<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Árboles Disponibles - Sistema de Gestión de Árboles</title>
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

    .card-body {
        padding: 1rem;
    }

    .card-title {
        color: #ffffff;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }

    .card-info {
        font-size: 0.85rem;
        color: #e0e0e0;
        margin-bottom: 0.5rem;
    }

    .card-info i {
        width: 20px;
        color: #adb5bd;
        margin-right: 8px;
    }

    .card-info p {
        margin-bottom: 0.5rem;
    }

    .price-tag {
        font-size: 1.2rem;
        font-weight: 600;
        color: #0dcaf0;
        padding: 0.5rem 0;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }

    .price-tag i {
        margin-right: 0.5rem;
    }

    .btn-primary {
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

    .btn-primary:hover {
        background-color: #0b5ed7;
        color: white;
        transform: translateY(-2px);
        text-decoration: none;
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

    .alert {
        border-radius: 10px;
        border: none;
        margin-bottom: 2rem;
    }

    .alert-success {
        background-color: rgba(28, 74, 28, 0.9);
        color: #9aff9a;
    }

    .alert-danger {
        background-color: rgba(139, 32, 32, 0.9);
        color: #ffa5a5;
    }

    .alert-info {
        background-color: rgba(23, 64, 97, 0.9);
        color: #b6d8ef;
    }

    .tree-placeholder {
        background: rgba(35, 35, 35, 0.5);
        height: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .row {
        justify-content: center;
        gap: 1.5rem;
    }

    .col-auto {
        padding: 0;
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

    /* Ajuste para el botón volver */
    .btn-volver {
        background-color: #0d6efd;
        border: none;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        text-decoration: none;
        transition: all 0.3s ease;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-volver:hover {
        background-color: #0b5ed7;
        color: white;
        transform: translateY(-2px);
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
                        <a class="nav-link" href="<?= base_url('amigo/arboles') ?>">
                            <i class="bi bi-tree"></i> Mis Árboles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('amigo/arboles/disponibles') ?>">
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
                <h2>Árboles Disponibles</h2>
                <a href="<?= base_url('amigo/dashboard') ?>" class="btn-volver">
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

        <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <?php if (empty($trees)): ?>
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>
            No hay árboles disponibles en este momento.
        </div>
        <?php else: ?>
        <div class="row">
            <?php foreach ($trees as $tree): ?>
            <div class="col-auto">
                <div class="card">
                    <?php if (!empty($tree['foto_url'])): ?>
                    <img src="<?= base_url('uploads/arboles/' . $tree['foto_url']) ?>" class="card-img-top"
                        alt="Foto de <?= esc($tree['nombre_comercial']) ?>">
                    <?php else: ?>
                    <div class="tree-placeholder">
                        <i class="bi bi-tree-fill text-success" style="font-size: 4rem;"></i>
                    </div>
                    <?php endif; ?>

                    <div class="card-body">
                        <h5 class="card-title"><?= esc($tree['nombre_comercial']) ?></h5>
                        <div class="card-info">
                            <p class="mb-2">
                                <em><?= esc($tree['nombre_cientifico']) ?></em>
                            </p>
                            <p class="mb-2">
                                <i class="bi bi-geo-alt"></i>
                                <?= esc($tree['ubicacion_geografica']) ?>
                            </p>
                        </div>
                        <div class="price-tag">
                            <i class="bi bi-tag-fill"></i>
                            ₡<?= number_format($tree['precio'], 2) ?>
                        </div>
                        <a href="<?= base_url('amigo/arboles/comprar/' . $tree['id']) ?>" class="btn-primary">
                            <i class="bi bi-cart-plus"></i> Adquirir Árbol
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