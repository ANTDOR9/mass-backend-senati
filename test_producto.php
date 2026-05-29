<?php
require_once 'clases/Producto.php';

$incaKola = new Producto('INC500', 'Inca Kola 500ml', 3.50, 48, false);
echo $incaKola->getNombre() . "<br>";
echo $incaKola->getPrecio() . "<br>";
echo $incaKola->getDisponible() ? "Disponible" : "No disponible";
echo "<br><br>";

$escosa = new Producto('ESC500', 'Escosesa 500ml', 2.10, 50);
echo $escosa->getNombre() . "<br>";
echo $escosa->getPrecio() . "<br>";
echo $escosa->getDisponible() ? "Disponible" : "No disponible";
echo "<br><br>";

$arubaba = new Producto('ARB500', 'Arubaba 500ml', 5.10, 50);
echo $arubaba->getNombre() . "<br>";
echo $arubaba->getPrecio() . "<br>";
echo $arubaba->getDisponible() ? "Disponible" : "No disponible";
echo "<br><br>";

$cocacola = new Producto('COCA500', 'Cocacola 500ml', 3.10, 50);
echo $cocacola->getNombre() . "<br>";
echo $cocacola->getPrecio() . "<br>";
echo $cocacola->getDisponible() ? "Disponible" : "No disponible";
echo "<br><br>";
?>