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

    <?= view('componentes/navbar') ?>

    <div class="container mt-4">
        <h1 class="mb-4">
            <?php if($isAdmin): ?>
            Dashboard Administrador
            <?php elseif($isAmigo): ?>
            Mi Dashboard
            <?php else: ?>
            Dashboard Operador
            <?php endif; ?>
        </h1>

        <!-- Estadísticas -->
        <div class="row">
            <?php if($isAdmin): ?>
            <!-- Estadísticas Admin -->
            <div class="col-md-4 mb-4">
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

            <div class="col-md-4 mb-4">
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

            <?php elseif($isAmigo): ?>
            <!-- Estadísticas Amigo -->
            <div class="col-md-4 mb-4">
                <div class="card border-primary h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <i class="bi bi-tree-fill text-primary fs-1"></i>
                        </h5>
                        <h2 class="display-4 mb-3"><?= esc($stats['arboles_propios']) ?></h2>
                        <p class="card-text fs-5">Mis Árboles</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card border-success h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <i class="bi bi-shop text-success fs-1"></i>
                        </h5>
                        <h2 class="display-4 mb-3"><?= esc($stats['arboles_disponibles']) ?></h2>
                        <p class="card-text fs-5">Árboles Disponibles</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card border-info h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <i class="bi bi-clock-history text-info fs-1"></i>
                        </h5>
                        <h2 class="mb-3 fs-4">
                            <?= $stats['ultima_actualizacion'] ? date('d/m/Y', strtotime($stats['ultima_actualizacion'])) : 'Sin actualizaciones' ?>
                        </h2>
                        <p class="card-text fs-5">Última Actualización</p>
                    </div>
                </div>
            </div>

            <?php else: ?>
            <!-- Estadísticas Operador -->
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
            <?php endif; ?>
        </div>

        <!-- Accesos Rápidos -->
        <div class="row mt-4">
            <div class="col-12">
                <h2 class="mb-4 text-white">
                    <?= $isAdmin || !$isAmigo ? 'Accesos Rápidos' : 'Acciones Rápidas' ?>
                </h2>
            </div>

            <?php if($isAdmin): ?>
            <!-- Accesos Rápidos Admin -->
            <div class="col-md-3 mb-4">
                <a href="<?= base_url($baseRoute . '/staff') ?>" class="text-decoration-none">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-person-badge text-info fs-1"></i>
                            <h5 class="card-title mt-3">Gestionar Staff</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="<?= base_url($baseRoute . '/especies') ?>" class="text-decoration-none">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-tree text-success fs-1"></i>
                            <h5 class="card-title mt-3">Gestionar Especies</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="<?= base_url($baseRoute . '/arboles') ?>" class="text-decoration-none">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-flower1 text-danger fs-1"></i>
                            <h5 class="card-title mt-3">Gestionar Árboles</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="<?= base_url($baseRoute . '/amigos') ?>" class="text-decoration-none">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-people text-primary fs-1"></i>
                            <h5 class="card-title mt-3">Ver Amigos</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Acceso Rápido de Ver Historial (común para Admin y Operador) -->
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

            <?php elseif($isAmigo): ?>
            <!-- Accesos Rápidos Amigo -->
            <div class="col-md-4 mb-4">
                <a href="<?= base_url($baseRoute . '/arboles') ?>" class="text-decoration-none">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-tree text-success fs-1"></i>
                            <h5 class="card-title mt-3">Mis Árboles</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="<?= base_url($baseRoute . '/arboles/disponibles') ?>" class="text-decoration-none">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-shop text-primary fs-1"></i>
                            <h5 class="card-title mt-3">Comprar Árboles</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="<?= base_url($baseRoute . '/perfil') ?>" class="text-decoration-none">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-person-circle text-warning fs-1"></i>
                            <h5 class="card-title mt-3">Mi Perfil</h5>
                        </div>
                    </div>
                </a>
            </div>

            <?php else: ?>
            <!-- Accesos Rápidos Operador -->
            <div class="col-md-6 mb-4">
                <a href="<?= base_url($baseRoute . '/amigos') ?>" class="text-decoration-none">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-pencil-square text-primary fs-1"></i>
                            <h5 class="card-title mt-3">Registrar Actualización</h5>
                            <p class="card-text">Actualizar información de árboles de amigos</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Acceso Rápido de Ver Historial (común para Admin y Operador) -->
            <div class="col-md-6 mb-4">
                <a href="<?= base_url($baseRoute . '/historial') ?>" class="text-decoration-none">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-clock-history text-warning fs-1"></i>
                            <h5 class="card-title mt-3">Ver Historial</h5>
                            <p class="card-text">Consultar historial de actualizaciones</p>
                        </div>
                    </div>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>