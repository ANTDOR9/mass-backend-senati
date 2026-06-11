<?php
require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
?>
<style>
    .campo { width:100%; padding:10px 13px; border:1.5px solid #d7dde6; border-radius:8px; font-size:14px; transition:border-color .2s, box-shadow .2s; outline:none; }
    .campo:focus { border-color:#0066B3; box-shadow:0 0 0 3px rgba(0,102,179,0.12); }
    .campo[readonly] { background:#f4f6f9; color:#5b6677; cursor:not-allowed; }
    .btn-guardar { width:100%; margin-top:18px; padding:12px; border:none; border-radius:8px; background:#0066B3; color:#fff; font-weight:700; font-size:15px; cursor:pointer; transition:background .2s; }
    .btn-guardar:hover { background:#004F8C; }
    label { display:block; font-size:13px; font-weight:600; margin:14px 0 5px; color:#1a2230; }
</style>

<div style="display:flex;">
    <?php require __DIR__ . '/../layout/sidebar.php'; ?>
    <main style="flex:1;padding:36px;font-family:Arial,sans-serif;background:#f4f6f9;">
        <div style="max-width:480px;margin:auto;background:#fff;border-radius:14px;padding:30px 28px;box-shadow:0 4px 24px rgba(0,0,0,.07);">

            <h1 style="color:#0066B3;font-size:22px;margin-bottom:4px;">Editar producto</h1>
            <div style="height:3px;width:100%;background:#FFB81C;border-radius:2px;margin-bottom:20px;"></div>

            <?php if (!empty($error)): ?>
            <div style="background:#fef2f2;border:1px solid #f3c2c2;color:#b91c1c;padding:10px 13px;border-radius:8px;font-size:13px;margin-bottom:14px;">
                ⚠️ <?= htmlspecialchars($error) ?>
            </div>
            <?php endif; ?>

            <form action="index.php?accion=actualizar-producto" method="POST">

                <label>Código de barras <span style="color:#5b6677;font-weight:400;">(no editable)</span></label>
                <input class="campo" type="text" value="<?= htmlspecialchars($producto->getCodigo()) ?>" readonly>
                <input type="hidden" name="codigo" value="<?= htmlspecialchars($producto->getCodigo()) ?>">

                <label>Nombre</label>
                <input class="campo" type="text" name="nombre" required minlength="3"
                       value="<?= htmlspecialchars($producto->getNombre()) ?>">

                <label>Precio (S/)</label>
                <input class="campo" type="number" name="precio" step="0.01" min="0.01" required
                       value="<?= htmlspecialchars((string)$producto->getPrecio()) ?>">

                <label>Stock</label>
                <input class="campo" type="number" name="stock" min="0" required
                       value="<?= htmlspecialchars((string)$producto->getStock()) ?>">

                <button class="btn-guardar" type="submit">Guardar cambios</button>
            </form>

            <p style="margin-top:16px;font-size:13px;text-align:center;">
                <a href="index.php?accion=catalogo" style="color:#0066B3;text-decoration:none;">← Cancelar y volver al catálogo</a>
            </p>
        </div>
    </main>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
