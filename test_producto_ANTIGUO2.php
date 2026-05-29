<?php
require_once 'clases/Producto.php';

$incaKola = new Producto('INC500', 'Inca Kola 500ml', 3.50, 48, false);
echo $incaKola->nombre . "<br>";
echo $incaKola->precio . "<br>";
echo $incaKola->disponible ? "Disponible" : "No disponible";
echo "<br><br>";

$escosa = new Producto('ESC500', 'Escosesa 500ml', 2.10, 50);
echo $escosa->nombre . "<br>";
echo $escosa->precio . "<br>";
echo $escosa->disponible ? "Disponible" : "No disponible";
echo "<br><br>";

$arubaba = new Producto('ARB500', 'Arubaba 500ml', 5.10, 50);
echo $arubaba->nombre . "<br>";
echo $arubaba->precio . "<br>";
echo $arubaba->disponible ? "Disponible" : "No disponible";
echo "<br><br>";

$cocacola = new Producto('COCA500', 'Cocacola 500ml', 3.10, 50);
echo $cocacola->nombre . "<br>";
echo $cocacola->precio . "<br>";
echo $cocacola->disponible ? "Disponible" : "No disponible";
echo "<br><br>";
?>