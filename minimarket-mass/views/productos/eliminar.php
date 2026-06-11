<?php
require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/navbar.php';
?>
<div style="display:flex;">
    <?php require __DIR__ . '/../layout/sidebar.php'; ?>
    <main style="flex:1;padding:36px;font-family:Arial,sans-serif;background:#f4f6f9;">
        <div style="max-width:460px;margin:auto;background:#fff;border-radius:14px;padding:30px 28px;box-shadow:0 4px 24px rgba(0,0,0,.07);">

            <h1 style="color:#c33;font-size:22px;margin-bottom:4px;">⚠️ Eliminar producto</h1>
            <div style="height:3px;width:100%;background:#c33;border-radius:2px;margin-bottom:20px;"></div>

            <p style="font-size:15px;color:#1a2230;margin-bottom:6px;">
                ¿Estás seguro de que deseas eliminar este producto?
            </p>
            <p style="font-size:13px;color:#5b6677;margin-bottom:20px;">
                Esta acción <strong>no se puede deshacer</strong>.
            </p>

            <div style="background:#f4f6f9;border:1px solid #e3e8ef;border-radius:10px;padding:14px 16px;margin-bottom:24px;">
                <p style="margin:4px 0;font-size:13px;"><strong>Código:</strong> <?= htmlspecialchars($producto->getCodigo()) ?></p>
                <p style="margin:4px 0;font-size:13px;"><strong>Nombre:</strong> <?= htmlspecialchars($producto->getNombre()) ?></p>
                <p style="margin:4px 0;font-size:13px;"><strong>Precio:</strong> S/ <?= number_format($producto->getPrecio(), 2) ?></p>
                <p style="margin:4px 0;font-size:13px;"><strong>Stock:</strong> <?= $producto->getStock() ?> unidades</p>
            </div>

            <form method="POST" action="index.php?accion=confirmar-eliminar">
                <input type="hidden" name="codigo" value="<?= htmlspecialchars($producto->getCodigo()) ?>">
                <button type="submit"
                        style="width:100%;padding:12px;border:none;border-radius:8px;background:#c33;color:#fff;font-weight:700;font-size:15px;cursor:pointer;"
                        onmouseover="this.style.background='#a00'"
                        onmouseout="this.style.background='#c33'">
                    🗑️ Sí, eliminar producto
                </button>
            </form>

            <p style="margin-top:14px;font-size:13px;text-align:center;">
                <a href="index.php?accion=catalogo" style="color:#0066B3;text-decoration:none;">← Cancelar y volver al catálogo</a>
            </p>
        </div>
    </main>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
