<!-- app/Views/amigo/perfil.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), url('https://www.arenalobservatorylodge.com/wp-content/uploads/2023/01/Volcan-Arenal-4.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        color: #ffffff;
        font-family: 'Poppins', sans-serif;
    }

    .card {
        background: rgba(45, 45, 45, 0.85);
        backdrop-filter: blur(10px);
        border: none !important;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        color: #ffffff;
    }

    .card-header {
        background-color: rgba(61, 61, 61, 0.9);
        color: #ffffff;
        font-weight: 600;
    }

    .form-control {
        background-color: rgba(61, 61, 61, 0.9);
        border-color: rgba(165, 174, 255, 0.3);
        color: #ffffff;
    }

    .form-control:focus {
        background-color: rgba(61, 61, 61, 0.9);
        border-color: #a5aeff;
        color: #ffffff;
        box-shadow: 0 0 0 0.25rem rgba(165, 174, 255, 0.25);
    }

    .btn-primary {
        background-color: #a5aeff;
        border-color: #a5aeff;
        color: #2d2d2d;
    }

    .btn-primary:hover {
        background-color: #8790e6;
        border-color: #8790e6;
    }

    .text-primary {
        color: #a5aeff !important;
    }

    .form-control::placeholder {
        color: #999;
    }

    .alert {
        background: rgba(45, 45, 45, 0.9);
        backdrop-filter: blur(10px);
        border: none;
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
    </style>
</head>

<body>
    <?= view('/componentes/amigoNavbar', ['baseRoute' => 'amigo']) ?>

    <div class="container py-5">
        <?php if (session()->getFlashdata('success_message')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success_message') ?>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error_message')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= session()->getFlashdata('error_message') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <div class="row">
            <!-- Columna de Información Personal -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Información Personal</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('amigo/perfil/update') ?>" method="POST">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    value="<?= esc($profile->nombre) ?>">
                                <?php if (session()->getFlashdata('errors.nombre')): ?>
                                <div class="text-danger mt-1"><?= session()->getFlashdata('errors.nombre') ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="apellidos" class="form-label">Apellidos:</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos"
                                    value="<?= esc($profile->apellidos) ?>">
                                <?php if (session()->getFlashdata('errors.apellidos')): ?>
                                <div class="text-danger mt-1"><?= session()->getFlashdata('errors.apellidos') ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?= esc($profile->email) ?>">
                                <?php if (session()->getFlashdata('errors.email')): ?>
                                <div class="text-danger mt-1"><?= session()->getFlashdata('errors.email') ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono"
                                    value="<?= esc($profile->telefono) ?>">
                                <?php if (session()->getFlashdata('errors.telefono')): ?>
                                <div class="text-danger mt-1"><?= session()->getFlashdata('errors.telefono') ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección:</label>
                                <textarea class="form-control" id="direccion" name="direccion"
                                    rows="3"><?= esc($profile->direccion) ?></textarea>
                                <?php if (session()->getFlashdata('errors.direccion')): ?>
                                <div class="text-danger mt-1"><?= session()->getFlashdata('errors.direccion') ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="pais" class="form-label">País:</label>
                                <input type="text" class="form-control" id="pais" name="pais"
                                    value="<?= esc($profile->pais) ?>">
                                <?php if (session()->getFlashdata('errors.pais')): ?>
                                <div class="text-danger mt-1"><?= session()->getFlashdata('errors.pais') ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="new_password" class="form-label">
                                    Nueva Contraseña: (Dejar en blanco para mantener la actual)
                                </label>
                                <input type="password" class="form-control" id="new_password" name="new_password">
                                <?php if (session()->getFlashdata('errors.new_password')): ?>
                                <div class="text-danger mt-1"><?= session()->getFlashdata('errors.new_password') ?>
                                </div>
                                <?php endif; ?>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Actualizar Perfil</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Columna de Información de Cuenta y Estadísticas -->
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Información de la Cuenta</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Rol:</strong> <?= esc($profile->rol_nombre) ?></p>
                        <p><strong>Fecha de Registro:</strong>
                            <?= date('d/m/Y', strtotime($profile->created_at)) ?></p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4>Estadísticas</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Mis Árboles:</strong> <?= $stats['arboles_propios'] ?></p>
                        <p><strong>Última Actualización:</strong>
                            <?= $stats['ultima_actualizacion'] 
                                ? date('d/m/Y H:i', strtotime($stats['ultima_actualizacion'])) 
                                : 'Sin actualizaciones' ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>