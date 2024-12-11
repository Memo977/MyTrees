<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Personal - Sistema de Gestión de Árboles</title>
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
                    <h2>Gestión de Personal</h2>
                </div>
                <a href="<?= base_url('admin/staff/create') ?>" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Nuevo Miembro
                </a>
            </div>
        </div>

        <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('message') ?>
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
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?= esc($usuario['id']) ?></td>
                                <td><?= esc($usuario['nombre']) ?> <?= esc($usuario['apellidos']) ?></td>
                                <td><?= esc($usuario['email']) ?></td>
                                <td><?= $usuario['rol_id'] == 1 ? 'Administrador' : 'Operador' ?></td>
                                <td>
                                    <div class="buttons-container">
                                        <a href="<?= base_url('admin/staff/edit/' . $usuario['id']) ?>"
                                            class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <?php if ($usuario['id'] != $current_user_id): ?>
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="confirmarEliminacion(<?= $usuario['id'] ?>)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <?php endif; ?>
                                    </div>
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
        if (confirm('¿Está seguro que desea eliminar este miembro del staff?')) {
            window.location.href = `<?= base_url('admin/staff/delete') ?>/${id}`;
        }
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>