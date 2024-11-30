<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Actualizaciones - <?= esc($arbol['nombre_comercial']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)),
            url('https://www.arenalobservatorylodge.com/wp-content/uploads/2023/01/Volcan-Arenal-4.jpg');
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
        animation: fadeIn 0.5s ease-out;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-header {
        background-color: rgba(61, 61, 61, 0.7);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding: 1.5rem;
        border-radius: 15px 15px 0 0 !important;
    }

    .table {
        color: #ffffff;
        margin-bottom: 0;
    }

    .table th {
        background-color: rgba(61, 61, 61, 0.7);
        border-color: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        font-weight: 600;
    }

    .table td {
        color: #ffffff !important;
        border-color: rgba(255, 255, 255, 0.1);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(92, 107, 192, 0.1);
        color: #ffffff !important;
    }

    .table-hover tbody tr:hover td {
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

    .btn-secondary {
        background-color: rgba(108, 117, 125, 0.9);
        border-color: transparent;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .btn-secondary:hover {
        background-color: rgba(83, 91, 99, 0.95);
        border-color: transparent;
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

    .img-thumbnail {
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        transition: transform 0.3s ease;
    }

    .img-thumbnail:hover {
        transform: scale(1.1);
    }

    .badge {
        padding: 0.5em 0.8em;
        font-weight: 500;
        color: #ffffff;
    }

    .badge.bg-success {
        background-color: rgba(40, 167, 69, 0.9) !important;
    }

    .badge.bg-secondary {
        background-color: rgba(108, 117, 125, 0.9) !important;
    }

    .page-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at center, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.6) 100%);
        pointer-events: none;
        z-index: -1;
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
    </style>
</head>

<body>
    <div class="page-overlay"></div>
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
                        <a class="nav-link active" href="<?= base_url('admin/arboles') ?>">
                            <i class="bi bi-flower1"></i> Árboles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/amigos') ?>">
                            <i class="bi bi-people"></i> Amigos
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

    <div class="container">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="buttons-container">
                    <h2>Historial de Actualizaciones</h2>
                </div>
                <a href="<?= site_url('admin/amigos/arboles/'.$arbol['usuario_id']) ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Árbol: <?= esc($arbol['nombre_comercial']) ?></h5>
                <p class="mb-0">
                    Propietario: <?= esc($arbol['amigo_nombre']) ?><br>
                    Ubicación: <?= esc($arbol['ubicacion_geografica']) ?>
                </p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Fecha</th>
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
                                <td><?= esc($actualizacion['tamanio_actual']) ?> m</td>
                                <td><?= esc($actualizacion['estado']) ?></td>
                                <td><?= esc($actualizacion['descripcion']) ?></td>
                                <td>
                                    <?php if (!empty($actualizacion['foto'])): ?>
                                    <img src="<?= base_url('uploads/actualizaciones/'.$actualizacion['foto']) ?>"
                                        alt="Foto de actualización" class="img-thumbnail" style="max-width: 100px;">
                                    <?php else: ?>
                                    <span class="text-muted">Sin foto</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No hay actualizaciones registradas para este árbol.
                                </td>
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