<?php

require_once 'clases/Producto.php';

$incaKola = new Producto('INC500', 'Inca Kola 500ml', 3.50, 48);
echo $incaKola->nombre . "<br>";
echo $incaKola->precio . "<br>";

$escosa = new Producto('ESC500', 'Escosesa 500ml', 2.10, 50);
echo $escosa->nombre . "<br>";
echo $escosa->precio . "<br>";

$arubaba = new Producto('ARB500', 'Arubaba 500ml', 5.10, 50);
echo $arubaba->nombre . "<br>";
echo $arubaba->precio . "<br>";

$cocacola = new Producto('COCA500', 'Cocacola 500ml', 3.10, 50);
echo $cocacola->nombre . "<br>";
echo $cocacola->precio . "<br>";

?>