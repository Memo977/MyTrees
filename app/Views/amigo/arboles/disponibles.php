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
    <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet">
</head>

<body>

    <?= view('/componentes/amigoNavbar', ['baseRoute' => 'amigo']) ?>

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