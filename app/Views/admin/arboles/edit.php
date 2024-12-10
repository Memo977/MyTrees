<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Árbol - Sistema de Gestión de Árboles</title>
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
        animation: fadeIn 0.5s ease-out;
    }

    .card-header {
        background-color: rgba(61, 61, 61, 0.7);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 15px 15px 0 0 !important;
        padding: 1.5rem;
    }

    .card-title {
        color: #ffffff;
        margin: 0;
        font-weight: 600;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .card-body {
        padding: 2rem;
    }

    .form-label {
        color: #e0e0e0;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .form-control,
    .form-select {
        background-color: rgba(61, 61, 61, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #ffffff;
        backdrop-filter: blur(5px);
        padding: 0.75rem;
        border-radius: 8px;
    }

    .form-control:focus,
    .form-select:focus {
        background-color: rgba(61, 61, 61, 0.9);
        border-color: rgba(92, 107, 192, 0.5);
        color: #ffffff;
        box-shadow: 0 0 0 0.25rem rgba(92, 107, 192, 0.25);
    }

    .form-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
    }

    .form-select option {
        background-color: rgba(45, 45, 45, 0.95);
        color: #ffffff;
    }

    .input-group-text {
        background-color: rgba(61, 61, 61, 0.9);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #ffffff;
    }

    .btn {
        padding: 0.625rem 1.25rem;
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: rgba(92, 107, 192, 0.9);
        border-color: transparent;
    }

    .btn-primary:hover {
        background-color: rgba(63, 81, 181, 0.95);
        transform: translateY(-2px);
    }

    .btn-secondary {
        background-color: rgba(108, 117, 125, 0.9);
        border-color: transparent;
    }

    .btn-secondary:hover {
        background-color: rgba(90, 98, 104, 0.95);
        transform: translateY(-2px);
    }

    .img-thumbnail {
        background-color: rgba(61, 61, 61, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 0.5rem;
        max-width: 200px;
        height: auto;
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
    </style>
</head>

<body>
    <div class="page-overlay"></div>
    <?= view('/componentes/adminNavbar', ['baseRoute' => 'admin']) ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Editar Árbol</h2>
                    </div>
                    <div class="card-body">
                        <?= form_open_multipart('admin/arboles/update/' . $tree['id']) ?>
                        <!-- Campo oculto para la redirección -->
                        <input type="hidden" name="redirect_to" value="<?= $redirect_to ?? 'admin/arboles' ?>">

                        <?php if (!empty($tree['usuario_id'])): ?>
                        <input type="hidden" name="usuario_id" value="<?= $tree['usuario_id'] ?>">
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="especie_id" class="form-label">Especie</label>
                            <select class="form-select" id="especie_id" name="especie_id" required>
                                <option value="">Seleccione una especie</option>
                                <?php foreach ($species as $specie): ?>
                                <option value="<?= $specie['id'] ?>"
                                    <?= ($specie['id'] == $tree['especie_id']) ? 'selected' : '' ?>>
                                    <?= esc($specie['nombre_comercial']) ?>
                                    (<?= esc($specie['nombre_cientifico']) ?>)
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="ubicacion" class="form-label">Ubicación Geográfica</label>
                            <textarea class="form-control" id="ubicacion" name="ubicacion_geografica" rows="3"
                                required><?= old('ubicacion_geografica', esc($tree['ubicacion_geografica'])) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" name="estado" required>
                                <option value="Disponible" <?= ($tree['estado'] == 'Disponible') ? 'selected' : '' ?>>
                                    Disponible
                                </option>
                                <option value="Vendido" <?= ($tree['estado'] == 'Vendido') ? 'selected' : '' ?>>
                                    Vendido
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <div class="input-group">
                                <span class="input-group-text">₡</span>
                                <input type="number" class="form-control" id="precio" name="precio" step="0.01" min="0"
                                    required value="<?= old('precio', esc($tree['precio'])) ?>">
                            </div>
                        </div>

                        <?php if (!empty($tree['foto_url'])): ?>
                        <div class="mb-3">
                            <label class="form-label">Foto Actual</label>
                            <div>
                                <img src="<?= base_url('uploads/arboles/' . $tree['foto_url']) ?>" alt="Árbol"
                                    class="img-thumbnail">
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="photo" class="form-label">Nueva Foto (opcional)</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= base_url($redirect_to ?? 'admin/arboles') ?>"
                                class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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