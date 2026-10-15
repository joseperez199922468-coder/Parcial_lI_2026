<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($titulo) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <main class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h1 class="h5 mb-0"><?= esc($titulo) ?></h1>
                    </div>
                    <div class="card-body">
                        <?php if ($validation && $validation->getErrors()): ?>
                            <div class="alert alert-danger" role="alert">
                                <ul class="mb-0">
                                    <?php foreach ($validation->getErrors() as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form action="<?= esc($accion) ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="mb-3">
                                <label for="id" class="form-label">ID</label>
                                <input class="form-control" id="id" name="id" type="number" min="1" step="1" value="<?= esc($editorial['id'] ?? '') ?>" <?= $esNuevo ? 'required' : 'readonly' ?>>
                                <?php if ($esNuevo): ?>
                                    <div class="form-text">Ingresa un ID único para la editorial.</div>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input class="form-control" id="nombre" name="nombre" type="text" maxlength="150" value="<?= esc($editorial['nombre'] ?? '') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input class="form-control" id="direccion" name="direccion" type="text" maxlength="255" value="<?= esc($editorial['direccion'] ?? '') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input class="form-control" id="telefono" name="telefono" type="tel" maxlength="30" value="<?= esc($editorial['telefono'] ?? '') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input class="form-control" id="email" name="email" type="email" maxlength="150" value="<?= esc($editorial['email'] ?? '') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="url" class="form-label">URL</label>
                                <input class="form-control" id="url" name="url" type="url" maxlength="255" value="<?= esc($editorial['url'] ?? $editorial['URL'] ?? '') ?>" required>
                            </div>

                            <div class="d-flex gap-2">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                                <a class="btn btn-secondary" href="<?= esc(site_url('editoriales')) ?>">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
