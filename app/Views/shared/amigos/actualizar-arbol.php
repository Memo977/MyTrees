<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Árbol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/shared/amigos/actualizar-arbol.css') ?>" rel="stylesheet">

</head>

<body>

    <?= view('componentes/navbar') ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Registrar Actualización de Árbol</h3>
                    </div>
                    <div class="card-body">
                        <?= form_open_multipart($baseRoute . '/amigos/actualizar-arboles') ?>
                        <input type="hidden" name="arbol_id" value="<?= $arbol['id'] ?>">

                        <div class="mb-3">
                            <label for="tamanio" class="form-label">Tamaño Actual (metros)</label>
                            <input type="number" class="form-control" id="tamanio" name="tamanio" step="0.01" min="0"
                                required value="<?= old('tamanio', $arbol['tamanio']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" name="estado" required>
                                <option value="Disponible"
                                    <?= old('estado', $arbol['estado']) == 'Disponible' ? 'selected' : '' ?>>
                                    Disponible
                                </option>
                                <option value="Vendido"
                                    <?= old('estado', $arbol['estado']) == 'Vendido' ? 'selected' : '' ?>>
                                    Vendido
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción de la actualización</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"
                                placeholder="Describe los cambios o novedades observadas en el árbol..."><?= old('descripcion') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="photo" class="form-label">Foto de la actualización (opcional)</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= base_url($baseRoute . '/amigos/arboles/'.$arbol['usuario_id']) ?>"
                                class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar Actualización</button>
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