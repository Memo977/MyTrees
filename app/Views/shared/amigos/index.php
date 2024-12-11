<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Amigos - Sistema de Gestión de Árboles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet">
</head>

<body>

    <?= view('componentes/navbar') ?>

    <div class="container">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="buttons-container">
                    <h2>Gestión de Amigos</h2>
                </div>
                <a href="<?= base_url($baseRoute . '/dashboard') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
            </div>
        </div>

        <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-<?= session()->getFlashdata('type') ?> alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('message') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>País</th>
                                <th>Fecha de Registro</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($amigos as $amigo): ?>
                            <tr>
                                <td><?= esc($amigo['nombre']) ?></td>
                                <td><?= esc($amigo['apellidos']) ?></td>
                                <td><?= esc($amigo['email']) ?></td>
                                <td><?= esc($amigo['telefono']) ?></td>
                                <td><?= esc($amigo['direccion']) ?></td>
                                <td><?= esc($amigo['pais']) ?></td>
                                <td><?= date('d/m/Y', strtotime($amigo['created_at'])) ?></td>
                                <td>
                                    <a href="<?= base_url($baseRoute . '/amigos/arboles/' . $amigo['id']) ?>"
                                        class="btn btn-primary btn-sm">
                                        <i class="bi bi-tree"></i> Ver Árboles
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>