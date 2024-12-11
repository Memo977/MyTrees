<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Especies - Sistema de Gestión de Árboles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="<?= base_url('assets/css/admin/especies/index.css') ?>" rel="stylesheet">
</head>

<body>
    <?= view('/componentes/adminNavbar', ['baseRoute' => 'admin']) ?>

    <div class="container">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="buttons-container">
                    <h2>Gestión de Especies</h2>
                </div>
                <a href="<?= base_url('admin/especies/create') ?>" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Nueva Especie
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
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre Comercial</th>
                                <th>Nombre Científico</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($especies as $especie): ?>
                            <tr>
                                <td><?= esc($especie['id']) ?></td>
                                <td><?= esc($especie['nombre_comercial']) ?></td>
                                <td><em><?= esc($especie['nombre_cientifico']) ?></em></td>
                                <td>
                                    <a href="<?= base_url('admin/especies/edit/' . $especie['id']) ?>"
                                        class="btn btn-sm btn-primary me-1">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger"
                                        onclick="confirmarEliminacion(<?= $especie['id'] ?>)">
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
        if (confirm('¿Está seguro que desea eliminar esta especie?')) {
            window.location.href = `<?= base_url('admin/especies/delete') ?>/${id}`;
        }
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>