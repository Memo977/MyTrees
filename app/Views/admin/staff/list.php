<!-- app/Views/admin/staff/list.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Staff - Sistema de Gestión de Árboles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="<?= base_url('assets/css/adminDashboard.css') ?>" rel="stylesheet">
</head>

<body>
    <div class="page-overlay"></div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url('admin/dashboard') ?>">
                <i class="bi bi-tree"></i> Un Millón de Árboles
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/especies') ?>">
                            <i class="bi bi-tree"></i> Especies
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/arboles') ?>">
                            <i class="bi bi-flower1"></i> Árboles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/amigos') ?>">
                            <i class="bi bi-people"></i> Amigos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('admin/staff') ?>">
                            <i class="bi bi-person-badge"></i> Staff
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> <?= session()->get('nombre') ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('logout') ?>">
                                    <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                                </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Gestión de Staff</h1>
            <a href="<?= base_url('admin/staff/create') ?>" class="btn btn-primary">
                <i class="bi bi-person-plus"></i> Nuevo Usuario Staff
            </a>
        </div>

        <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('message') ?>
        </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <?php if (empty($usuarios)): ?>
                <div class="text-center py-5">
                    <i class="bi bi-people-fill text-muted" style="font-size: 4rem;"></i>
                    <h4 class="mt-3">No hay usuarios staff registrados</h4>
                    <p class="text-muted">Para agregar un nuevo usuario staff, haz clic en el botón "Nuevo Usuario
                        Staff"</p>
                </div>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?= esc($usuario['nombre']) ?></td>
                                <td><?= esc($usuario['email']) ?></td>
                                <td>
                                    <?= $usuario['rol_id'] == 1 ? 'Administrador' : 'Operador' ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/staff/edit/' . $usuario['id']) ?>"
                                        class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <?php if ($usuario['id'] != $current_user_id): ?>
                                    <a href="<?= base_url('admin/staff/delete/' . $usuario['id']) ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>