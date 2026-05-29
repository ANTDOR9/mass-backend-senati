<?php
// ============================================
// TAREA T02 - Sistema de bonificación de cajeros
// Mass Minimarket - Backend Developer Web SENATI
// ============================================

// --- DATOS DE ENTRADA ---
$nombre = "Carlos Quispe";
$dni = "45678912";
$ventas_mes = 22000;
$antiguedad = 3;
$tienda = "Mass Arequipa - Av. Ejército";

// --- 1. VALIDACIÓN DE DNI ---
if (strlen($dni) !== 8 || !ctype_digit($dni)) {
    echo "<p style='color:red'>ERROR: DNI inválido. Debe tener 8 dígitos numéricos.</p>";
    exit;
}

// --- 2. BONO BASE POR VENTAS (if/elseif) ---
if ($ventas_mes < 10000) {
    $porcentaje_bono = 0;
    $bono_base = 0;
    $nivel_ventas = "Sin bono";
} elseif ($ventas_mes <= 20000) {
    $porcentaje_bono = 3;
    $bono_base = $ventas_mes * 0.03;
    $nivel_ventas = "Nivel Bronce";
} elseif ($ventas_mes <= 35000) {
    $porcentaje_bono = 5;
    $bono_base = $ventas_mes * 0.05;
    $nivel_ventas = "Nivel Plata";
} else {
    $porcentaje_bono = 7;
    $bono_base = $ventas_mes * 0.07;
    $nivel_ventas = "Nivel Oro";
}

// --- 3. BONO ADICIONAL POR ANTIGÜEDAD (switch) ---
switch (true) {
    case ($antiguedad < 1):
        $bono_antiguedad = 0;
        $categoria_antiguedad = "Nuevo ingreso";
        break;
    case ($antiguedad <= 2):
        $bono_antiguedad = 50;
        $categoria_antiguedad = "Junior";
        break;
    case ($antiguedad <= 4):
        $bono_antiguedad = 100;
        $categoria_antiguedad = "Intermedio";
        break;
    default:
        $bono_antiguedad = 200;
        $categoria_antiguedad = "Senior";
}

// --- 4. CÁLCULO FINAL ---
$bono_total = $bono_base + $bono_antiguedad;

// --- 5. SALUDO SEGÚN HORA ---
$hora = (int) date("H");
if ($hora >= 5 && $hora <= 11) {
    $saludo = "Buenos días";
} elseif ($hora >= 12 && $hora <= 18) {
    $saludo = "Buenas tardes";
} elseif ($hora >= 19 && $hora <= 23) {
    $saludo = "Buenas noches";
} else {
    $saludo = "Tienda cerrada";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bonificación Cajero - Mass</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            padding: 30px;
        }
        .reporte {
            background: white;
            width: 480px;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #e30613;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .logo {
            font-size: 42px;
            font-weight: 900;
            color: #e30613;
            letter-spacing: 4px;
        }
        .header p {
            margin: 4px 0;
            color: #555;
            font-size: 13px;
        }
        .saludo {
            background: #fff3f3;
            border-left: 4px solid #e30613;
            padding: 10px 15px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #333;
        }
        .seccion {
            margin-bottom: 18px;
        }
        .seccion h3 {
            font-size: 13px;
            text-transform: uppercase;
            color: #999;
            margin-bottom: 8px;
            border-bottom: 1px solid #eee;
            padding-bottom: 4px;
        }
        .fila {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            padding: 4px 0;
            color: #333;
        }
        .fila span:last-child {
            font-weight: bold;
        }
        .total-box {
            background: #e30613;
            color: white;
            padding: 15px 20px;
            border-radius: 6px;
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 11px;
            color: #aaa;
        }
        .badge {
            display: inline-block;
            background: #fff3f3;
            color: #e30613;
            border: 1px solid #e30613;
            border-radius: 4px;
            padding: 2px 8px;
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="reporte">

    <!-- ENCABEZADO -->
    <div class="header">
        <div class="logo">MASS</div>
        <p>Minimarket · <?php echo $tienda; ?></p>
        <p>Reporte de Bonificación Mensual</p>
        <p><?php echo date("d/m/Y H:i:s"); ?></p>
    </div>

    <!-- SALUDO -->
    <div class="saludo">
        <?php echo $saludo . ", " . $nombre; ?> 👋
    </div>

    <!-- DATOS DEL CAJERO -->
    <div class="seccion">
        <h3>Datos del cajero</h3>
        <div class="fila"><span>Nombre</span><span><?php echo $nombre; ?></span></div>
        <div class="fila"><span>DNI</span><span><?php echo $dni; ?></span></div>
        <div class="fila"><span>Antigüedad</span><span><?php echo $antiguedad; ?> año(s) — <span class="badge"><?php echo $categoria_antiguedad; ?></span></span></div>
        <div class="fila"><span>Tienda</span><span><?php echo $tienda; ?></span></div>
    </div>

    <!-- VENTAS DEL MES -->
    <div class="seccion">
        <h3>Ventas del mes</h3>
        <div class="fila"><span>Total vendido</span><span>S/ <?php echo number_format($ventas_mes, 2); ?></span></div>
        <div class="fila"><span>Nivel alcanzado</span><span><span class="badge"><?php echo $nivel_ventas; ?></span></span></div>
    </div>

    <!-- DESGLOSE DE BONIFICACIÓN -->
    <div class="seccion">
        <h3>Desglose de bonificación</h3>
        <div class="fila">
            <span>Bono base (<?php echo $porcentaje_bono; ?>% de ventas)</span>
            <span>S/ <?php echo number_format($bono_base, 2); ?></span>
        </div>
        <div class="fila">
            <span>Bono antigüedad (<?php echo $antiguedad; ?> año(s))</span>
            <span>S/ <?php echo number_format($bono_antiguedad, 2); ?></span>
        </div>
    </div>

    <!-- TOTAL -->
    <div class="total-box">
        <span>BONO TOTAL A PAGAR</span>
        <span>S/ <?php echo number_format($bono_total, 2); ?></span>
    </div>

    <div class="footer">
        SENATI · CFP Arequipa · Backend Developer Web<br>
        Generado el <?php echo date("d/m/Y \a \l\a\s H:i"); ?>
    </div>

</div>
</body>
</html>