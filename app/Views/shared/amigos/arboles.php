<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Árboles de <?= esc($amigo['nombre']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/shared/amigos/arboles.css') ?>" rel="stylesheet">

</head>

<body>

    <?= view('componentes/navbar') ?>

    <div class="container">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="buttons-container">
                    <h2>Árboles de <?= esc($amigo['nombre']) ?></h2>
                </div>
                <a href="<?= base_url($baseRoute . '/amigos') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Especie</th>
                                <th>Ubicación</th>
                                <th>Estado</th>
                                <th>Tamaño</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($arboles)): ?>
                            <?php foreach ($arboles as $arbol): ?>
                            <tr>
                                <td><?= esc($arbol['nombre_comercial']) ?></td>
                                <td><?= esc($arbol['ubicacion_geografica']) ?></td>
                                <td><?= esc($arbol['estado']) ?></td>
                                <td><?= esc($arbol['tamanio']) ?> m</td>
                                <td>
                                    <?php if($isAdmin): ?>
                                    <a href="<?= base_url($baseRoute . '/arboles/edit/'.$arbol['id'].'?from=amigos&usuario_id='.$amigo['id']) ?>"
                                        class="btn btn-primary btn-sm me-1">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <?php endif; ?>

                                    <a href="<?= base_url($baseRoute . '/amigos/actualizar-arbol/'.$arbol['id']) ?>"
                                        class="btn btn-info btn-sm me-1">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </a>
                                    <a href="<?= base_url($baseRoute . '/amigos/historial/'.$arbol['id']) ?>"
                                        class="btn btn-secondary btn-sm">
                                        <i class="bi bi-clock-history"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No hay árboles registrados para este amigo.</td>
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