<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Árbol - Sistema de Gestión de Árboles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="<?= base_url('assets/css/amigo/arboles/detalle.css') ?>" rel="stylesheet">
</head>

<body>

    <?= view('/componentes/amigoNavbar', ['baseRoute' => 'amigo']) ?>

    <div class="container">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Detalles</h2>
                <a href="<?= base_url('amigo/arboles') ?>" class="btn-volver">
                    <i class="bi bi-arrow-left me-2"></i> Volver
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Información General -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="bi bi-tree-fill me-2"></i>Información General</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($arbol['foto_url'])): ?>
                        <div class="tree-image-container">
                            <img src="<?= base_url('uploads/arboles/' . $arbol['foto_url']) ?>" class="tree-image"
                                alt="Foto de <?= esc($arbol['nombre_comercial']) ?>">
                        </div>
                        <?php else: ?>
                        <div class="tree-image-placeholder">
                            <div class="no-image-content">
                                <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                <p class="mb-0 mt-2 text-muted">Sin Foto</p>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="info-group">
                            <div class="info-label">
                                <i class="bi bi-tag"></i>
                                Nombre Comercial
                            </div>
                            <div class="info-value"><?= esc($arbol['nombre_comercial']) ?></div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">
                                <i class="bi bi-hash"></i>
                                Nombre Científico
                            </div>
                            <div class="info-value"><?= esc($arbol['nombre_cientifico']) ?></div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">
                                <i class="bi bi-check-circle"></i>
                                Estado
                            </div>
                            <div class="info-value">
                                <span class="badge-estado"><?= esc($arbol['estado']) ?></span>
                            </div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">
                                <i class="bi bi-geo-alt"></i>
                                Ubicación
                            </div>
                            <div class="info-value"><?= esc($arbol['ubicacion_geografica']) ?></div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">
                                <i class="bi bi-rulers"></i>
                                Tamaño Actual
                            </div>
                            <div class="info-value"><?= esc($arbol['tamanio']) ?> metros</div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">
                                <i class="bi bi-calendar3"></i>
                                Fecha de Adquisición
                            </div>
                            <div class="info-value"><?= date('d/m/Y', strtotime($arbol['fecha_venta'])) ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Historial de Actualizaciones -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="bi bi-clock-history me-2"></i>Historial de Actualizaciones</h5>
                    </div>
                    <div class="card-body">
                        <?php if (empty($historial)): ?>
                        <div class="text-center p-4">
                            <i class="bi bi-clipboard-x text-muted" style="font-size: 2rem;"></i>
                            <p class="mt-3 text-muted">No hay actualizaciones registradas</p>
                        </div>
                        <?php else: ?>
                        <?php foreach ($historial as $actualizacion): ?>
                        <div class="timeline-item">
                            <div class="timeline-date">
                                <i class="bi bi-calendar2-event"></i>
                                <?= date('d/m/Y H:i', strtotime($actualizacion['fecha_actualizacion'])) ?>
                            </div>

                            <div class="timeline-badge">
                                <i class="bi bi-rulers"></i>
                                <?= esc($actualizacion['tamanio_actual']) ?> metros
                            </div>

                            <?php if (!empty($actualizacion['foto'])): ?>
                            <div class="update-image-container">
                                <img src="<?= base_url('uploads/actualizaciones/' . $actualizacion['foto']) ?>"
                                    class="update-image" alt="Foto de actualización">
                            </div>
                            <?php else: ?>
                            <div class="update-image-placeholder">
                                <div class="no-image-content">
                                    <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
                                    <p class="mb-0 mt-2 text-muted">Sin Foto</p>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if (!empty($actualizacion['descripcion'])): ?>
                            <div class="timeline-content">
                                <?= esc($actualizacion['descripcion']) ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>