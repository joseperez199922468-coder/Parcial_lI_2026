<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editoriales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid p-1">
        <?php if ($mensaje = session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show py-2" role="alert">
                <?= esc($mensaje) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        <?php endif; ?>

        <div class="mb-2">
            <a class="btn btn-primary btn-sm" href="<?= esc(site_url('editoriales/nueva')) ?>">Agregar Editorial</a>
        </div>

        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped align-middle text-center small mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Correo electrónico</th>
                        <th scope="col">URL</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($editoriales)): ?>
                        <?php foreach ($editoriales as $editorial): ?>
                            <tr>
                                <td><?= esc($editorial['id'] ?? $editorial['Id'] ?? '') ?></td>
                                <td><?= esc($editorial['nombre'] ?? '') ?></td>
                                <td><?= esc($editorial['direccion'] ?? '') ?></td>
                                <td><?= esc($editorial['telefono'] ?? '') ?></td>
                                <td><?= esc($editorial['email'] ?? '') ?></td>
                                <td><?= esc($editorial['url'] ?? $editorial['URL'] ?? '') ?></td>
                                <td class="text-nowrap">
                                    <a class="btn btn-link btn-sm text-dark p-1" href="<?= esc(site_url('editoriales/editar/' . ($editorial['id'] ?? $editorial['Id'] ?? ''))) ?>" aria-label="Editar editorial" title="Editar">
                                        <i class="bi bi-pencil" aria-hidden="true"></i>
                                    </a>
                                    <form class="d-inline" action="<?= esc(site_url('editoriales/eliminar/' . ($editorial['id'] ?? $editorial['Id'] ?? ''))) ?>" method="post" onsubmit="return confirm('¿Deseas eliminar esta editorial?');">
                                        <?= csrf_field() ?>
                                        <button class="btn btn-link btn-sm text-primary p-1" type="submit" aria-label="Eliminar editorial" title="Eliminar">
                                            <i class="bi bi-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No hay editoriales registradas.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
