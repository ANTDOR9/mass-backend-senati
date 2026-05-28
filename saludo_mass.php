<?php


// ── Obtener la hora actual (0 - 23) ─────────────────────────
$hora = (int) date("H");

// ── Determinar el turno con if ───────────────────────────────
if ($hora >= 5 && $hora <= 11) {
    $turno = "mañana";
} elseif ($hora >= 12 && $hora <= 18) {
    $turno = "tarde";
} elseif ($hora >= 19 && $hora <= 23) {
    $turno = "noche";
} else {
    $turno = "cerrado";
}

// ── Mostrar saludo con switch ────────────────────────────────
switch ($turno) {
    case "mañana":
        echo "Buenos días, bienvenido a Mass";
        break;
    case "tarde":
        echo "Buenas tardes, bienvenido a Mass";
        break;
    case "noche":
        echo "Buenas noches, bienvenido a Mass";
        break;
    case "cerrado":
        echo "Tienda cerrada en este horario";
        break;
}

echo "\n(Hora actual del servidor: " . $hora . ":00)";


?>