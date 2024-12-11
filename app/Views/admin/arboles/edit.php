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
    <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet">
</head>

<body>

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