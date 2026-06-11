<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/navbar.php'; ?>
<div style="display:flex;">
    <?php require __DIR__ . '/../layout/sidebar.php'; ?>
    <main style="flex:1;padding:30px;font-family:Arial,sans-serif;background:#f4f6f9;">

        <h1 style="color:#0066B3;border-bottom:3px solid #FFB81C;padding-bottom:10px;margin-bottom:20px;">
            Catálogo del Minimarket Mass
        </h1>

        <?php if (isset($_GET['exito'])): ?>
        <div style="background:#ecfdf3;border:1px solid #86efac;color:#16a34a;padding:10px 16px;border-radius:8px;font-size:13px;margin-bottom:16px;">
            ✅ Producto guardado correctamente.
        </div>
        <?php endif; ?>

        <p>Total de productos: <strong><?= count($productos) ?></strong></p>
        <table style="width:100%;border-collapse:collapse;background:white;box-shadow:0 2px 4px rgba(0,0,0,0.1);margin-top:16px;">
            <thead>
                <tr>
                    <th style="background:#0066B3;color:white;padding:12px;text-align:left;">Código</th>
                    <th style="background:#0066B3;color:white;padding:12px;text-align:left;">Nombre</th>
                    <th style="background:#0066B3;color:white;padding:12px;text-align:left;">Precio</th>
                    <th style="background:#0066B3;color:white;padding:12px;text-align:left;">Precio con IGV</th>
                    <th style="background:#0066B3;color:white;padding:12px;text-align:left;">Stock</th>
                    <th style="background:#0066B3;color:white;padding:12px;text-align:left;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $p): ?>
                <tr style="border-bottom:1px solid #eee;">
                    <td style="padding:10px 12px;"><?= htmlspecialchars($p->getCodigo()) ?></td>
                    <td style="padding:10px 12px;"><?= htmlspecialchars($p->getNombre()) ?></td>
                    <td style="padding:10px 12px;font-weight:bold;color:#0066B3;">S/ <?= number_format($p->getPrecio(), 2) ?></td>
                    <td style="padding:10px 12px;font-weight:bold;color:#0066B3;">S/ <?= number_format($p->precioConIGV(), 2) ?></td>
                    <td style="padding:10px 12px;<?= $p->getStock() === 0 ? 'color:#c33;' : '' ?>">
                        <?= $p->getStock() ?> unidades
                    </td>
                    <td style="padding:10px 12px;">
                        <a href="index.php?accion=editar-producto&codigo=<?= urlencode($p->getCodigo()) ?>"
                           style="background:#0066B3;color:white;padding:5px 12px;border-radius:6px;text-decoration:none;font-size:13px;font-weight:600;">
                            ✏️ Editar</a>
                        <a href="index.php?accion=eliminar-producto&codigo=<?= urlencode($p->getCodigo()) ?>"
                           style="background:#c33;color:white;padding:5px 12px;border-radius:6px;text-decoration:none;font-size:13px;font-weight:600;margin-left:6px;">
                            🗑️ Eliminar
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>
