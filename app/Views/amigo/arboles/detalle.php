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
        max-width: 1200px;
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
        font-weight: 500;
        margin: 0;
    }

    .btn-volver {
        background: #0d6efd;
        color: white;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        font-weight: 500;
    }

    .btn-volver:hover {
        background: #0b5ed7;
        color: white;
        transform: translateY(-2px);
    }

    .card {
        background: rgba(45, 45, 45, 0.85);
        backdrop-filter: blur(10px);
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
        margin-bottom: 2rem;
    }

    .card-header {
        background: rgba(35, 35, 35, 0.5);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 15px 15px 0 0 !important;
        padding: 1rem 1.5rem;
    }

    .card-header h5 {
        color: #fff;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
    }

    .card-body {
        padding: 1.5rem;
    }

    .tree-image-container {
        width: 100%;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        margin-bottom: 2rem;
    }

    .tree-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .tree-image:hover {
        transform: scale(1.02);
    }

    .tree-image-placeholder {
        background: rgba(35, 35, 35, 0.5);
        border-radius: 15px;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 2rem;
    }

    .no-image-content {
        text-align: center;
    }

    .no-image-content p {
        font-size: 0.9rem;
    }

    .info-group {
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .info-group:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .info-label {
        color: #adb5bd;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }

    .info-label i {
        margin-right: 0.5rem;
        color: #17a2b8;
    }

    .info-value {
        color: #fff;
        font-size: 1.1rem;
        font-weight: 500;
    }

    .badge-estado {
        display: inline-block;
        background-color: #17a2b8;
        color: white;
        padding: 0.5em 1em;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .timeline-item {
        position: relative;
        padding: 1.5rem;
        background: rgba(35, 35, 35, 0.5);
        border-radius: 12px;
        margin-bottom: 1.5rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: transform 0.3s ease;
    }

    .timeline-item:hover {
        transform: translateY(-2px);
    }

    .timeline-date {
        color: #17a2b8;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        font-weight: 500;
        display: flex;
        align-items: center;
    }

    .timeline-date i {
        margin-right: 0.5rem;
    }

    .timeline-badge {
        background-color: rgba(23, 162, 184, 0.2);
        color: #17a2b8;
        padding: 0.3em 0.8em;
        border-radius: 15px;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
    }

    .timeline-badge i {
        margin-right: 0.3rem;
    }

    .timeline-content {
        background: rgba(255, 255, 255, 0.05);
        padding: 1rem;
        border-radius: 8px;
        margin-top: 0.5rem;
        color: #e0e0e0;
    }

    .update-image-container {
        width: 100%;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        margin: 1rem 0;
    }

    .update-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .update-image:hover {
        transform: scale(1.02);
    }

    .update-image-placeholder {
        background: rgba(35, 35, 35, 0.5);
        border-radius: 10px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 1rem 0;
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

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url('amigo/dashboard') ?>">
                <i class="bi bi-tree"></i> Un Millón de Árboles
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('amigo/dashboard') ?>">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('amigo/arboles') ?>">
                            <i class="bi bi-tree"></i> Mis Árboles
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('amigo/arboles-disponibles') ?>">
                            <i class="bi bi-shop"></i> Comprar
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
                            <li><a class="dropdown-item" href="<?= base_url('amigo/perfil') ?>">
                                    <i class="bi bi-person"></i> Mi Perfil
                                </a></li>
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
                <h2>Detalles del Árbol</h2>
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