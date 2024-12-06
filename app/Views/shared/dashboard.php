<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Gestión de Árboles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="<?= base_url('assets/css/adminDashboard.css') ?>" rel="stylesheet">
</head>

<body>
    <div class="page-overlay"></div>
    <?php 
    $isAdmin = session()->get('rol_id') == 1;
    $baseRoute = $isAdmin ? 'admin' : 'operador';
    ?>

    <!-- Navbar -->
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
                        <a class="nav-link active" href="<?= base_url($baseRoute . '/dashboard') ?>">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <?php if($isAdmin): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/especies') ?>">
                            <i class="bi bi-tree"></i> Especies
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/arboles') ?>">
                            <i class="bi bi-flower1"></i> Árboles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/amigos') ?>">
                            <i class="bi bi-people"></i> Amigos
                        </a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url($baseRoute . '/historial') ?>">
                            <i class="bi bi-clock-history"></i> Historial de Árboles
                        </a>
                    </li>
                    <?php endif; ?>
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

    <div class="container mt-4">
        <h1 class="mb-4">Dashboard <?= $isAdmin ? 'Administrador' : 'Operador' ?></h1>

        <!-- Estadísticas -->
        <div class="row">
            <div class="col-md-<?= $isAdmin ? '4' : '6' ?> mb-4">
                <div class="card border-primary h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <i class="bi bi-people-fill text-primary fs-1"></i>
                        </h5>
                        <h2 class="display-4 mb-3"><?= esc($stats['amigos']) ?></h2>
                        <p class="card-text fs-5">Amigos Registrados</p>
                    </div>
                </div>
            </div>

            <div class="col-md-<?= $isAdmin ? '4' : '6' ?> mb-4">
                <div class="card border-success h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <i class="bi bi-tree-fill text-success fs-1"></i>
                        </h5>
                        <h2 class="display-4 mb-3"><?= esc($stats['arboles_disponibles']) ?></h2>
                        <p class="card-text fs-5">Árboles Disponibles</p>
                    </div>
                </div>
            </div>

            <?php if($isAdmin): ?>
            <div class="col-md-4 mb-4">
                <div class="card border-info h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <i class="bi bi-cart-check-fill text-info fs-1"></i>
                        </h5>
                        <h2 class="display-4 mb-3"><?= esc($stats['arboles_vendidos']) ?></h2>
                        <p class="card-text fs-5">Árboles Vendidos</p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Accesos Rápidos -->
        <div class="row mt-4">
            <div class="col-12">
                <h2 class="mb-4 text-white">
                    <?= $isAdmin ? 'Accesos Rápidos' : 'Acciones Rápidas' ?>
                </h2>
            </div>

            <?php if($isAdmin): ?>
            <!-- Accesos para Admin -->
            <div class="col-md-3 mb-4">
                <a href="<?= base_url('admin/staff') ?>" class="text-decoration-none">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-person-badge text-info fs-1"></i>
                            <h5 class="card-title mt-3">Gestionar Staff</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="<?= base_url('admin/especies') ?>" class="text-decoration-none">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-tree text-success fs-1"></i>
                            <h5 class="card-title mt-3">Gestionar Especies</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="<?= base_url('admin/arboles') ?>" class="text-decoration-none">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-flower1 text-danger fs-1"></i>
                            <h5 class="card-title mt-3">Gestionar Árboles</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="<?= base_url('admin/amigos') ?>" class="text-decoration-none">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-people text-primary fs-1"></i>
                            <h5 class="card-title mt-3">Ver Amigos</h5>
                        </div>
                    </div>
                </a>
            </div>

            <?php else: ?>
            <!-- Accesos para Operador -->
            <div class="col-md-6 mb-4">
                <a href="<?= base_url('operador/amigos/actualizar-arbol') ?>" class="text-decoration-none">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-pencil-square text-primary fs-1"></i>
                            <h5 class="card-title mt-3">Registrar Actualización</h5>
                            <p class="card-text">Actualizar información de árboles de amigos</p>
                        </div>
                    </div>
                </a>
            </div>
            <?php endif; ?>

            <!-- Historial (común para ambos roles) -->
            <div class="col-md-<?= $isAdmin ? '3' : '6' ?> mb-4">
                <a href="<?= base_url($baseRoute . '/historial') ?>" class="text-decoration-none">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-clock-history text-warning fs-1"></i>
                            <h5 class="card-title mt-3">Ver Historial</h5>
                            <?php if(!$isAdmin): ?>
                            <p class="card-text">Consultar historial de actualizaciones</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>