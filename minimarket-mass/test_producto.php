<?php
require_once 'clases/Producto.php';

$incaKola = new Producto('INC500', 'Inca Kola 500ml', 3.50, 48);
echo $incaKola->getNombre() . "<br>";
echo $incaKola->getPrecio() . "<br>";
echo $incaKola->precioConIGV() . "<br>";
echo $incaKola->haySuficienteStock(10) ? "Hay stock" : "Sin stock";
echo "<br><br>";

$escosa = new Producto('ESC500', 'Escosesa 500ml', 2.10, 50);
echo $escosa->getNombre() . "<br>";
echo $escosa->getPrecio() . "<br>";
echo $escosa->precioConIGV() . "<br>";
echo $escosa->haySuficienteStock(10) ? "Hay stock" : "Sin stock";
echo "<br><br>";

$arubaba = new Producto('ARB500', 'Arubaba 500ml', 5.10, 50);
echo $arubaba->getNombre() . "<br>";
echo $arubaba->getPrecio() . "<br>";
echo $arubaba->precioConIGV() . "<br>";
echo $arubaba->haySuficienteStock(10) ? "Hay stock" : "Sin stock";
echo "<br><br>";

$cocacola = new Producto('COCA500', 'Cocacola 500ml', 3.10, 50);
echo $cocacola->getNombre() . "<br>";
echo $cocacola->getPrecio() . "<br>";
echo $cocacola->precioConIGV() . "<br>";
echo $cocacola->haySuficienteStock(10) ? "Hay stock" : "Sin stock";
echo "<br><br>";
?>