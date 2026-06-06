<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/conexion.php';

$pdo  = getConexion();
$stmt = $pdo->prepare(
    "SELECT codigo_barras AS codigo, nombre, precio, stock
     FROM productos
     WHERE stock < :umbral
     ORDER BY stock ASC"
);
$stmt->execute([':umbral' => 10]);
$productos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte 1 — Stock bajo</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        h1 { color: #0066B3; border-bottom: 3px solid #FFB81C; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        th { background: #0066B3; color: white; padding: 12px; text-align: left; }
        td { padding: 10px 12px; border-bottom: 1px solid #eee; }
        tr:hover { background: #f9f9f9; }
        .precio { font-weight: bold; color: #0066B3; }
        .bajo { color: #c33; font-weight: bold; }
        a { display: inline-block; margin-top: 20px; color: #0066B3; }
    </style>
</head>
<body>
    <h1>Reporte 1 — Productos con stock bajo (menos de 10 unidades)</h1>
    <p>Total encontrados: <strong><?= count($productos) ?></strong></p>
    <?php if (empty($productos)): ?>
        <p>No hay productos con stock bajo.</p>
    <?php else: ?>
    <table>
        <thead>
            <tr><th>Código</th><th>Nombre</th><th>Precio</th><th>Stock</th></tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p['codigo']) ?></td>
                <td><?= htmlspecialchars($p['nombre']) ?></td>
                <td class="precio">S/ <?= number_format((float)$p['precio'], 2) ?></td>
                <td class="bajo"><?= (int)$p['stock'] ?> unidades</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
    <a href="index.html">← Volver al menú</a>
</body>
</html>
