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
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)),
            url('<?= base_url('assets/images/background.jpg') ?>');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        color: #e0e0e0;
        min-height: 100vh;
    }

    .container {
        padding-top: 2rem;
        padding-bottom: 2rem;
    }

    .card {
        background: rgba(45, 45, 45, 0.85);
        backdrop-filter: blur(10px);
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .table {
        color: #e0e0e0;
        margin-bottom: 0;
    }

    .table th {
        background-color: rgba(61, 61, 61, 0.7);
        border-color: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        font-weight: 600;
    }

    .table td {
        border-color: rgba(255, 255, 255, 0.1);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(92, 107, 192, 0.1);
        color: #ffffff !important;
    }

    .btn-primary {
        background-color: rgba(92, 107, 192, 0.9);
        border-color: transparent;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .btn-primary:hover {
        background-color: rgba(63, 81, 181, 0.95);
        border-color: transparent;
        transform: translateY(-2px);
    }

    .btn-danger {
        background-color: rgba(220, 53, 69, 0.9);
        border-color: transparent;
        transition: all 0.3s ease;
    }

    .btn-danger:hover {
        background-color: rgba(200, 35, 51, 0.95);
        transform: translateY(-2px);
    }

    .alert {
        border-radius: 10px;
        border: none;
    }

    .alert-success {
        background-color: rgba(28, 74, 28, 0.9);
        border-color: rgba(39, 105, 39, 0.5);
        color: #9aff9a;
    }

    .alert-danger {
        background-color: rgba(74, 28, 28, 0.9);
        border-color: rgba(105, 39, 39, 0.5);
        color: #ff9a9a;
    }

    .page-header {
        background: rgba(45, 45, 45, 0.85);
        backdrop-filter: blur(10px);
        padding: 1.5rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
    }

    .page-header h2 {
        color: #ffffff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        margin: 0;
    }

    .table-responsive {
        border-radius: 10px;
        overflow: hidden;
    }

    .bi {
        margin-right: 0.25rem;
    }

    em {
        color: #a5aeff;
    }

    .buttons-container {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .navbar {
        background: rgba(45, 45, 45, 0.9) !important;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
    }

    .navbar-brand,
    .nav-link {
        color: #ffffff !important;
    }

    .nav-link:hover {
        color: #a5aeff !important;
    }

    .dropdown-menu {
        background: rgba(45, 45, 45, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .dropdown-item {
        color: #ffffff;
    }

    .dropdown-item:hover {
        background: rgba(92, 107, 192, 0.2);
        color: #a5aeff;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card {
        animation: fadeIn 0.5s ease-out;
    }
    </style>
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