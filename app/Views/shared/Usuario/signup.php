<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Un Millón de Árboles - Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)),
            url('<?= base_url('assets/images/background.jpg') ?>');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        color: #e0e0e0;
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
    }

    .main-title {
        text-align: center;
        margin-bottom: 2rem;
        color: #ffffff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        animation: fadeInDown 1s ease-out;
    }

    .main-title h1 {
        font-size: 5rem;
        font-weight: 700;
        font-style: italic;
        letter-spacing: 1px;
    }

    .main-title p {
        font-size: 1.2rem;
        font-weight: 300;
        font-style: italic;
        max-width: 600px;
        margin: 0 auto;
    }

    .container {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 2rem 0;
    }

    .card {
        background: rgba(45, 45, 45, 0.85);
        backdrop-filter: blur(10px);
        border: none;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
    }

    .form-label {
        color: #e0e0e0;
        font-weight: 500;
    }

    .form-control {
        background-color: rgba(61, 61, 61, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #ffffff;
    }

    .form-control:focus {
        background-color: rgba(61, 61, 61, 0.9);
        border-color: rgba(92, 107, 192, 0.5);
        color: #ffffff;
        box-shadow: 0 0 0 0.25rem rgba(92, 107, 192, 0.25);
    }

    .btn-primary {
        background-color: rgba(92, 107, 192, 0.9);
        border-color: transparent;
        transition: all 0.3s ease;
        font-weight: 500;
        padding: 0.625rem;
    }

    .btn-primary:hover {
        background-color: rgba(63, 81, 181, 0.95);
        transform: translateY(-1px);
    }

    .alert {
        animation: fadeIn 0.5s ease-out;
    }

    .alert-danger {
        background-color: rgba(74, 28, 28, 0.9);
        border-color: rgba(105, 39, 39, 0.5);
        color: #ff9a9a;
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

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    textarea.form-control {
        resize: none;
    }

    .card {
        animation: fadeIn 0.5s ease-out;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="main-title">
            <h1>Un Millón de Árboles</h1>
            <p>Juntos por un futuro más verde y sostenible</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h2 class="card-title text-center mb-4">Registro de Nuevo Usuario</h2>

                        <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                        <?php endif ?>

                        <form action="<?= base_url('signup') ?>" method="POST">
                            <?= csrf_field() ?>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        value="<?= old('nombre') ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="apellidos" class="form-label">Apellidos:</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos"
                                        value="<?= old('apellidos') ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Correo Electrónico:</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="<?= old('email') ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="telefono" class="form-label">Teléfono:</label>
                                    <input type="tel" class="form-control" id="telefono" name="telefono"
                                        value="<?= old('telefono') ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Contraseña:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="confirm_password" class="form-label">Confirmar Contraseña:</label>
                                    <input type="password" class="form-control" id="confirm_password"
                                        name="confirm_password" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="pais" class="form-label">País:</label>
                                    <input type="text" class="form-control" id="pais" name="pais"
                                        value="<?= old('pais') ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="direccion" class="form-label">Dirección:</label>
                                    <textarea class="form-control" id="direccion" name="direccion" rows="1"
                                        required><?= old('direccion') ?></textarea>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary">Registrarse</button>
                            </div>
                        </form>

                        <div class="text-center mt-3">
                            <p>¿Ya tienes una cuenta? <a href="<?= base_url('login') ?>">Inicia sesión aquí</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>