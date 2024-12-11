<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizaciones Globales de Árboles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="<?= base_url('assets/css/shared/historial/index.css') ?>" rel="stylesheet">
</head>

<body>

    <?= view('componentes/navbar') ?>

    <div class="container">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2>Actualizaciones Globales de Árboles</h2>
                </div>
                <a href="<?= base_url($baseRoute . '/dashboard') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Amigo</th>
                                <th>Especie</th>
                                <th>Tamaño</th>
                                <th>Estado</th>
                                <th>Descripción</th>
                                <th>Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($actualizaciones)): ?>
                            <?php foreach ($actualizaciones as $actualizacion): ?>
                            <tr>
                                <td><?= date('d/m/Y H:i', strtotime($actualizacion['fecha_actualizacion'])) ?></td>
                                <td><?= esc($actualizacion['nombre']) ?></td>
                                <td><?= esc($actualizacion['nombre_comercial']) ?></td>
                                <td><?= esc($actualizacion['tamanio_actual']) ?> m</td>
                                <td><?= esc($actualizacion['estado']) ?></td>
                                <td>
                                    <?php if (!empty($actualizacion['descripcion'])): ?>
                                    <?= esc($actualizacion['descripcion']) ?>
                                    <?php else: ?>
                                    <span class="text-muted">Sin descripción</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($actualizacion['foto'])): ?>
                                    <img src="<?= base_url('uploads/actualizaciones/' . $actualizacion['foto']) ?>"
                                        alt="Foto de actualización" class="img-thumbnail">
                                    <?php else: ?>
                                    <span class="text-muted">Sin foto</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No hay actualizaciones registradas.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>