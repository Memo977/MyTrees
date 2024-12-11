<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Árboles - Sistema de Gestión de Árboles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet">
</head>

<body>

    <?= view('/componentes/adminNavbar', ['baseRoute' => 'admin']) ?>

    <div class="container">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="buttons-container">
                    <h2>Gestión de Árboles</h2>
                </div>
                <a href="<?= base_url('admin/arboles/create') ?>" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Nuevo Árbol
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
                                <th>ID</th>
                                <th>Especie</th>
                                <th>Ubicación</th>
                                <th>Estado</th>
                                <th>Precio</th>
                                <th>Foto</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($trees as $tree): ?>
                            <tr>
                                <td><?= esc($tree['id']) ?></td>
                                <td><?= esc($tree['nombre_comercial']) ?></td>
                                <td><?= esc($tree['ubicacion_geografica']) ?></td>
                                <td>
                                    <span
                                        class="badge bg-<?= $tree['estado'] == 'Disponible' ? 'success' : 'secondary' ?>">
                                        <?= esc($tree['estado']) ?>
                                    </span>
                                </td>
                                <td>₡ <?= number_format($tree['precio'], 2) ?></td>
                                <td>
                                    <?php if (!empty($tree['foto_url'])): ?>
                                    <img src="<?= base_url('uploads/arboles/' . $tree['foto_url']) ?>" alt="Árbol"
                                        class="img-thumbnail" style="max-width: 100px;">
                                    <?php else: ?>
                                    <span class="text-muted">Sin foto</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/arboles/edit/' . $tree['id']) ?>"
                                        class="btn btn-primary btn-sm me-1">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="confirmarEliminacion(<?= $tree['id'] ?>)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
    function confirmarEliminacion(id) {
        if (confirm('¿Está seguro de eliminar este árbol?')) {
            window.location.href = `<?= base_url('admin/arboles/delete') ?>/${id}`;
        }
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>