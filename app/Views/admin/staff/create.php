<!-- app/Views/admin/staff/create.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Un Millón de Árboles - Crear Usuario Staff</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet">
</head>

<body>

    <?= view('/componentes/adminNavbar', ['baseRoute' => 'admin']) ?>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h2 class="card-title text-center mb-4">Crear Usuario Staff</h2>

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
                            <input type="hidden" name="is_staff_registration" value="1">

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
                                    <label for="rol_id" class="form-label">Rol:</label>
                                    <select class="form-select" id="rol_id" name="rol_id" required>
                                        <option value="">Seleccione un rol</option>
                                        <option value="1">Administrador</option>
                                        <option value="2">Operador</option>
                                    </select>
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
                                <button type="submit" class="btn btn-primary">Crear Usuario</button>
                                <a href="<?= base_url('admin/staff') ?>" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>