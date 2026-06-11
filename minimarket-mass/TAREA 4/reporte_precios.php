<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/conexion.php';

$pdo  = getConexion();
$stmt = $pdo->query(
    "SELECT codigo_barras AS codigo, nombre, precio, stock
     FROM productos
     ORDER BY precio DESC"
);
$productos = $stmt->fetchAll();
$igv = 0.18;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte 2 — Precios</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        h1 { color: #0066B3; border-bottom: 3px solid #FFB81C; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        th { background: #0066B3; color: white; padding: 12px; text-align: left; }
        td { padding: 10px 12px; border-bottom: 1px solid #eee; }
        tr:hover { background: #f9f9f9; }
        .precio { font-weight: bold; color: #0066B3; }
        a { display: inline-block; margin-top: 20px; color: #0066B3; }
    </style>
</head>
<body>
    <h1>Reporte 2 — Productos por precio (mayor a menor)</h1>
    <p>Total: <strong><?= count($productos) ?></strong> productos.</p>
    <table>
        <thead>
            <tr><th>#</th><th>Código</th><th>Nombre</th><th>Precio</th><th>Precio con IGV</th><th>Stock</th></tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $i => $p): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($p['codigo']) ?></td>
                <td><?= htmlspecialchars($p['nombre']) ?></td>
                <td class="precio">S/ <?= number_format((float)$p['precio'], 2) ?></td>
                <td class="precio">S/ <?= number_format((float)$p['precio'] * (1 + $igv), 2) ?></td>
                <td><?= (int)$p['stock'] ?> unidades</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.html">← Volver al menú</a>
</body>
</html>
