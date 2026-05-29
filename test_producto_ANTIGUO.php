<?php
declare(strict_types=1);
require_once 'clases/Producto.php';
echo  'GASEOSAS'."<br>"."<br>";
$incaKola = new Producto();
$incaKola->codigo = 'INC500';
$incaKola->nombre = 'Inca Kola 500ml';
$incaKola->precio = 3.50;
$incaKola->stock  = 48;

echo $incaKola->nombre . "<br>";
echo $incaKola->precio . "<br>";

$escosa = new Producto();
$escosa->codigo = 'ESC500';
$escosa->nombre = 'Escosesa 500ml';
$escosa->precio = 2.10;
$escosa->stock  = 50;

echo $escosa->nombre . "<br>";
echo $escosa->precio . "<br>";

$arubaba = new Producto();
$arubaba->codigo = 'ARB500';
$arubaba->nombre = 'Arubaba 500ml';
$arubaba->precio = 5.10;
$arubaba->stock  = 50;

echo $arubaba->nombre . "<br>";
echo $arubaba->precio . "<br>";

$cocacola = new Producto();
$cocacola->codigo = 'COCA500';
$cocacola->nombre = 'Cocacola 500ml';
$cocacola->precio = 3.10;
$cocacola->stock  = 50;

echo $cocacola->nombre . "<br>";
echo $cocacola->precio . "<br>";
?>