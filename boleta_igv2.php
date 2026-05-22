<?php
$subtotal1= "120.50";   
$igv = 0.18;                  
$subtotal2= (float) $subtotal1;  
//-------------
$monto_igv = $subtotal2 * $igv;
$total = $subtotal2 + $monto_igv;
echo "<center>". "BOLETA CON CALCULO IGV". "<br>". "----------------------------------------------". "<br>" ."Subtotal: S/ " . number_format($subtotal2, 2) . "<br>";
echo "IGV (18%): S/ " . number_format($monto_igv, 2) . "<br>";
echo  number_format($total, 2) . "<br>" . "</center>";

