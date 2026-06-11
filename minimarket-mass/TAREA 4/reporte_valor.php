<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/conexion.php';

$pdo  = getConexion();
$stmt = $pdo->query(
    "SELECT codigo_barras AS codigo, nombre, precio, stock,
            (precio * stock) AS valor_total
     FROM productos
     ORDER BY valor_total DESC"
);
$filas = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte 3 — Valor inventario</title>
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
    <h1>Reporte 3 — Valor del inventario por producto (precio × stock)</h1>
    <table>
        <thead>
            <tr><th>Código</th><th>Nombre</th><th>Precio</th><th>Stock</th><th>Valor total</th></tr>
        </thead>
        <tbody>
            <?php foreach ($filas as $f): ?>
            <tr>
                <td><?= htmlspecialchars($f['codigo']) ?></td>
                <td><?= htmlspecialchars($f['nombre']) ?></td>
                <td class="precio">S/ <?= number_format((float)$f['precio'], 2) ?></td>
                <td><?= (int)$f['stock'] ?> unidades</td>
                <td class="precio">S/ <?= number_format((float)$f['valor_total'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.html">← Volver al menú</a>
</body>
</html>
