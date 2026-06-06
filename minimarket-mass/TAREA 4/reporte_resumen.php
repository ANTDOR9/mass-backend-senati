<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/conexion.php';

$pdo  = getConexion();
$stmt = $pdo->query(
    "SELECT
        COUNT(*)            AS total_productos,
        SUM(stock)          AS total_unidades,
        SUM(precio * stock) AS valor_total_inventario
     FROM productos"
);
$resumen = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte 4 — Resumen general</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        h1 { color: #0066B3; border-bottom: 3px solid #FFB81C; padding-bottom: 10px; }
        table { width: 60%; border-collapse: collapse; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        th { background: #0066B3; color: white; padding: 12px; text-align: left; }
        td { padding: 10px 12px; border-bottom: 1px solid #eee; }
        .precio { font-weight: bold; color: #0066B3; }
        a { display: inline-block; margin-top: 20px; color: #0066B3; }
    </style>
</head>
<body>
    <h1>Reporte 4 — Resumen general del inventario</h1>
    <table>
        <thead>
            <tr><th>Indicador</th><th>Valor</th></tr>
        </thead>
        <tbody>
            <tr><td>Total de productos distintos</td><td class="precio"><?= (int)$resumen['total_productos'] ?></td></tr>
            <tr><td>Total de unidades en stock</td><td class="precio"><?= (int)$resumen['total_unidades'] ?></td></tr>
            <tr><td>Valor total del inventario</td><td class="precio">S/ <?= number_format((float)$resumen['valor_total_inventario'], 2) ?></td></tr>
        </tbody>
    </table>
    <a href="index.html">← Volver al menú</a>
</body>
</html>
