<?php
// TAREA 6 — Vista del catálogo con navbar, sidebar y footer integrados
require __DIR__ . '/../views/layout/header.php';
require __DIR__ . '/../views/layout/navbar.php';
?>
<div style="display:flex;">
    <?php require __DIR__ . '/../views/layout/sidebar.php'; ?>
    <main style="flex:1;padding:30px;font-family:Arial,sans-serif;background:#f4f6f9;">
        <h1 style="color:#0066B3;border-bottom:3px solid #FFB81C;padding-bottom:10px;margin-bottom:20px;">
            Catálogo del Minimarket Mass
        </h1>
        <p>Total de productos: <strong><?= count($productos) ?></strong></p>
        <table style="width:100%;border-collapse:collapse;background:white;box-shadow:0 2px 4px rgba(0,0,0,0.1);margin-top:16px;">
            <thead>
                <tr>
                    <th style="background:#0066B3;color:white;padding:12px;text-align:left;">Código</th>
                    <th style="background:#0066B3;color:white;padding:12px;text-align:left;">Nombre</th>
                    <th style="background:#0066B3;color:white;padding:12px;text-align:left;">Precio</th>
                    <th style="background:#0066B3;color:white;padding:12px;text-align:left;">Precio con IGV</th>
                    <th style="background:#0066B3;color:white;padding:12px;text-align:left;">Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $p): ?>
                <tr style="border-bottom:1px solid #eee;">
                    <td style="padding:10px 12px;"><?= htmlspecialchars($p->getCodigo()) ?></td>
                    <td style="padding:10px 12px;"><?= htmlspecialchars($p->getNombre()) ?></td>
                    <td style="padding:10px 12px;font-weight:bold;color:#0066B3;">S/ <?= number_format($p->getPrecio(), 2) ?></td>
                    <td style="padding:10px 12px;font-weight:bold;color:#0066B3;">S/ <?= number_format($p->precioConIGV(), 2) ?></td>
                    <td style="padding:10px 12px;" <?= $p->getStock() === 0 ? 'style="color:#c33;"' : '' ?>>
                        <?= $p->getStock() ?> unidades
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</div>
<?php require __DIR__ . '/../views/layout/footer.php'; ?>
