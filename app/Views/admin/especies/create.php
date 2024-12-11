<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Especie - Sistema de Gestión de Árboles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="<?= base_url('assets/css/admin/especies/create.css') ?>" rel="stylesheet">
</head>

<body>


    <?= view('/componentes/adminNavbar', ['baseRoute' => 'admin']) ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Nueva Especie</h2>
                    </div>
                    <div class="card-body">
                        <?= form_open('admin/especies') ?>
                        <div class="mb-4">
                            <label for="nombre_comercial" class="form-label">Nombre Comercial</label>
                            <input type="text" class="form-control" id="nombre_comercial" name="nombre_comercial"
                                value="<?= old('nombre_comercial') ?>" required>
                        </div>

                        <div class="mb-4">
                            <label for="nombre_cientifico" class="form-label">Nombre Científico</label>
                            <input type="text" class="form-control" id="nombre_cientifico" name="nombre_cientifico"
                                value="<?= old('nombre_cientifico') ?>" required>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= base_url('admin/especies') ?>" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar Especie</button>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>