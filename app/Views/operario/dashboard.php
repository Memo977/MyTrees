<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Operador - Sistema de Gestión de Árboles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="<?= base_url('assets/css/adminDashboard.css') ?>" rel="stylesheet">
</head>

<body>
    <div class="page-overlay"></div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url('operador/dashboard') ?>">
                <i class="bi bi-tree"></i> Un Millón de Árboles
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('operador/dashboard') ?>">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('operador/historial') ?>">
                            <i class="bi bi-clock-history"></i> Historial de Árboles
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

    <div class="container mt-4">
        <h1 class="mb-4">Dashboard Operador</h1>

        <!-- Estadísticas -->
        <div class="row">
            <div class="col-md-6 mb-4">
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

            <div class="col-md-6 mb-4">
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
        </div>

        <!-- Accesos Rápidos -->
        <div class="row mt-4">
            <div class="col-12">
                <h2 class="mb-4 text-white">Acciones Rápidas</h2>
            </div>

            <!-- Registrar Actualización -->
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

            <!-- Ver Historial -->
            <div class="col-md-6 mb-4">
                <a href="<?= base_url('shared/Historial/index') ?>" class="text-decoration-none">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-clock-history text-warning fs-1"></i>
                            <h5 class="card-title mt-3">Ver Historial</h5>
                            <p class="card-text">Consultar historial de actualizaciones</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>