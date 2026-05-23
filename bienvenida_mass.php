<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido a BOREALIS - Minimarket Mass</title>
</head>
<body>

<?php
// Variables con la información requerida
$nombre_tienda = "BOREALIS";
$nombre_propietario = "ANTHONY DORLY HUILAHUAÑA CHATA";
$fecha_hoy = date("d/m/Y");
$categorias = array("Abarrotes", "Lácteos y huevos", "Bebidas y gaseosas");
$promocion_dia = "¡Lleva 2 panes y llévate 1 gratis! Válido hasta agotar stock.";
?>

<h1>Bienvenido a Mass — <?php echo $nombre_tienda; ?></h1>

<p>Hoy es: <?php echo $fecha_hoy; ?></p>

<p>Atendido por: <?php echo $nombre_propietario; ?></p>

<ul>
    <li><?php echo $categorias[0]; ?></li>
    <li><?php echo $categorias[1]; ?></li>
    <li><?php echo $categorias[2]; ?></li>
</ul>

<p><strong>Promoción del día: <?php echo $promocion_dia; ?></strong></p>

</body>
</html>
