<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Compra - Sistema de Gestión de Árboles</title>
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
        font-weight: 600;
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

    .card-header {
        background: rgba(35, 35, 35, 0.5);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 15px 15px 0 0 !important;
        padding: 1rem 1.5rem;
    }

    .card-header h4 {
        color: #ffffff;
        margin: 0;
        font-weight: 600;
    }

    .card-body {
        padding: 1.5rem;
    }

    .img-fluid {
        border-radius: 10px;
        max-height: 300px;
        width: 100%;
        object-fit: cover;
    }

    .tree-placeholder {
        background: rgba(35, 35, 35, 0.5);
        height: 300px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .list-unstyled {
        margin-bottom: 0;
    }

    .list-unstyled li {
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .list-unstyled li:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .list-label {
        display: block;
        color: #adb5bd;
        font-size: 0.9rem;
        margin-bottom: 0.3rem;
    }

    .list-value {
        color: #ffffff;
        font-size: 1.1rem;
    }

    .price-value {
        color: #0dcaf0;
        font-size: 1.5rem;
        font-weight: 600;
    }

    .alert-info {
        background-color: rgba(23, 64, 97, 0.9);
        border: none;
        color: #b6d8ef;
        border-radius: 10px;
    }

    .btn-primary {
        background-color: #0d6efd;
        border: none;
        padding: 0.8rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
        transform: translateY(-2px);
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
        padding: 0.8rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        transform: translateY(-2px);
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

    .scientific-name {
        font-style: italic;
        color: #adb5bd;
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
                <h2>Confirmar Compra</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Detalles del Árbol</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <?php if (!empty($arbol['foto_url'])): ?>
                                <img src="<?= base_url('uploads/arboles/' . $arbol['foto_url']) ?>" class="img-fluid"
                                    alt="Foto de <?= esc($arbol['nombre_comercial']) ?>">
                                <?php else: ?>
                                <div class="tree-placeholder">
                                    <i class="bi bi-tree-fill text-success" style="font-size: 6rem;"></i>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li>
                                        <span class="list-label">Nombre Comercial</span>
                                        <span class="list-value"><?= esc($arbol['nombre_comercial']) ?></span>
                                    </li>
                                    <li>
                                        <span class="list-label">Nombre Científico</span>
                                        <span
                                            class="list-value scientific-name"><?= esc($arbol['nombre_cientifico']) ?></span>
                                    </li>
                                    <li>
                                        <span class="list-label">Ubicación</span>
                                        <span class="list-value">
                                            <i class="bi bi-geo-alt text-primary me-1"></i>
                                            <?= esc($arbol['ubicacion_geografica']) ?>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="list-label">Precio</span>
                                        <span class="price-value">₡<?= number_format($arbol['precio'], 2) ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="alert alert-info mt-4">
                            <i class="bi bi-info-circle-fill me-2"></i>
                            Al confirmar la compra, este árbol quedará registrado como suyo y podrá realizar seguimiento
                            de su crecimiento y estado.
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="<?= base_url('amigo/arboles/disponibles') ?>" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Cancelar
                            </a>
                            <form action="<?= base_url('amigo/arboles/confirmar-compra') ?>" method="POST"
                                class="d-inline">
                                <input type="hidden" name="arbol_id" value="<?= $arbol['id'] ?>">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-cart-check"></i> Confirmar Compra
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>