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
    <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet">
</head>

<body>

    <?= view('/componentes/amigoNavbar', ['baseRoute' => 'amigo']) ?>

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