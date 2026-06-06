<?php

$monto = 169;
switch ($monto ) {
    case $monto <= 0:
        echo "No puede ser negativo, campeón";
        break;
    case $monto > 0 && $monto < 30:
        echo "Sin descuento";
        break;
    case $monto < 99.99:
        echo "Felicidades, tienes un descuento del 5%";
        break;
    case $monto >= 100 && $monto < 199.99:
        echo "Felicidades, tienes un descuento del 10%";
        break;
    case $monto >=200:
        echo "Felicidades, tienes un descuento del 15%";
        break;
    
    default:
}

?>