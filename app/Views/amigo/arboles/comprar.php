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
    <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet">
</head>

<body>

    <?= view('/componentes/amigoNavbar', ['baseRoute' => 'amigo']) ?>

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