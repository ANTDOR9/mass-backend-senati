<?php
// ============================================
// TAREA T02 - Sistema de bonificación de cajeros
// Mass Minimarket - Backend Developer Web SENATI
// ============================================


// --- DATOS DE ENTRADA ---
$nombre     = "Carlos Quispe";
$dni        = "45678912";
$ventas_mes = 22000;
$antiguedad = 3;
$tienda     = "Mass Arequipa - Av. Ejército";

// --- 1. VALIDACIÓN DE DNI ---
if (strlen($dni) !== 8 || !ctype_digit($dni)) {
    echo "<!DOCTYPE html><html><body style='font-family:Arial;display:flex;justify-content:center;padding:40px'>
    <div style='background:#fff3cd;border:2px solid #ffc107;padding:20px;border-radius:8px;max-width:400px'>
    <h3 style='color:#856404;margin:0'>⚠️ DNI Inválido</h3>
    <p style='color:#856404'>El DNI debe tener exactamente 8 dígitos numéricos.</p>
    </div></body></html>";
    exit;
}

// --- 2. BONO BASE POR VENTAS ---
if ($ventas_mes < 10000) {
    $porcentaje_bono = 0;
    $bono_base       = 0;
    $nivel_ventas    = "Sin bono";
    $nivel_icon      = "—";
} elseif ($ventas_mes <= 20000) {
    $porcentaje_bono = 3;
    $bono_base       = $ventas_mes * 0.03;
    $nivel_ventas    = "Nivel Bronce";
    $nivel_icon      = "🥉";
} elseif ($ventas_mes <= 35000) {
    $porcentaje_bono = 5;
    $bono_base       = $ventas_mes * 0.05;
    $nivel_ventas    = "Nivel Plata";
    $nivel_icon      = "🥈";
} else {
    $porcentaje_bono = 7;
    $bono_base       = $ventas_mes * 0.07;
    $nivel_ventas    = "Nivel Oro";
    $nivel_icon      = "🥇";
}

// --- 3. BONO POR ANTIGÜEDAD ---
switch (true) {
    case ($antiguedad < 1):
        $bono_antiguedad      = 0;
        $categoria_antiguedad = "Nuevo ingreso";
        break;
    case ($antiguedad <= 2):
        $bono_antiguedad      = 50;
        $categoria_antiguedad = "Junior";
        break;
    case ($antiguedad <= 4):
        $bono_antiguedad      = 100;
        $categoria_antiguedad = "Intermedio";
        break;
    default:
        $bono_antiguedad      = 200;
        $categoria_antiguedad = "Senior";
}

// --- 4. TOTAL ---
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
    $saludo = "Turno nocturno";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonificación Cajero - Mass</title>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;900&family=Barlow:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --mass-yellow: #F5C200;
            --mass-blue:   #1E1EAA;
            --mass-dark:   #111133;
            --mass-light:  #F5F7FF;
            --mass-gray:   #6B7280;
        }

        body {
            font-family: 'Barlow', sans-serif;
            background: var(--mass-light);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px 20px;
        }

        .ticket {
            width: 100%;
            max-width: 520px;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(30,30,170,0.15);
        }

        /* HEADER */
        .header {
            background: var(--mass-yellow);
            padding: 28px 32px 20px;
            text-align: center;
            position: relative;
        }
        .header img {
            height: 70px;
            object-fit: contain;
        }
        .header-sub {
            margin-top: 8px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--mass-blue);
            opacity: 0.75;
        }

        /* FRANJA AZUL */
        .stripe {
            background: var(--mass-blue);
            padding: 10px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .stripe span {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.7);
        }
        .stripe strong {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: var(--mass-yellow);
        }

        /* SALUDO */
        .saludo {
            background: #EEF0FF;
            border-left: 4px solid var(--mass-blue);
            padding: 12px 32px;
            font-size: 14px;
            font-weight: 500;
            color: var(--mass-blue);
        }

        /* BODY */
        .body { padding: 24px 32px; }

        .seccion { margin-bottom: 24px; }
        .seccion-titulo {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--mass-gray);
            border-bottom: 1px solid #E5E7EB;
            padding-bottom: 6px;
            margin-bottom: 12px;
        }

        .fila {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px 0;
            font-size: 14px;
            color: #374151;
        }
        .fila .label { color: var(--mass-gray); }
        .fila .valor { font-weight: 600; color: var(--mass-dark); }

        .badge {
            display: inline-block;
            background: #EEF0FF;
            color: var(--mass-blue);
            border: 1px solid var(--mass-blue);
            border-radius: 20px;
            padding: 2px 10px;
            font-size: 12px;
            font-weight: 600;
        }

        /* DESGLOSE */
        .desglose-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--mass-light);
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 8px;
            font-size: 14px;
        }
        .desglose-item .concepto { color: #374151; }
        .desglose-item .monto { font-weight: 700; color: var(--mass-blue); }

        /* DIVIDER */
        .divider {
            border: none;
            border-top: 2px dashed #E5E7EB;
            margin: 20px 0;
        }

        /* TOTAL */
        .total-box {
            background: var(--mass-blue);
            border-radius: 12px;
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
        .total-box .total-label {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.75);
        }
        .total-box .total-monto {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 32px;
            font-weight: 900;
            color: var(--mass-yellow);
        }

        /* FOOTER */
        .footer {
            background: var(--mass-blue);
            padding: 14px 32px;
            text-align: center;
        }
        .footer p {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.5);
        }

        /* ANIMACIÓN */
        .ticket { animation: fadeUp 0.5s ease both; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
<div class="ticket">

    <!-- HEADER -->
    <div class="header">
        <img src="logo_mass.png" alt="Mass">
        <div class="header-sub">Reporte de Bonificación Mensual</div>
    </div>

    <!-- FRANJA AZUL -->
    <div class="stripe">
        <span><?php echo $tienda; ?></span>
        <strong><?php echo date("d/m/Y H:i"); ?></strong>
    </div>

    <!-- SALUDO -->
    <div class="saludo">
        👋 <?php echo $saludo . ", <strong>" . $nombre . "</strong>"; ?>
    </div>

    <div class="body">

        <!-- DATOS DEL CAJERO -->
        <div class="seccion">
            <div class="seccion-titulo">Datos del cajero</div>
            <div class="fila">
                <span class="label">Nombre</span>
                <span class="valor"><?php echo $nombre; ?></span>
            </div>
            <div class="fila">
                <span class="label">DNI</span>
                <span class="valor"><?php echo $dni; ?></span>
            </div>
            <div class="fila">
                <span class="label">Antigüedad</span>
                <span class="valor">
                    <?php echo $antiguedad; ?> año(s)
                    &nbsp;<span class="badge"><?php echo $categoria_antiguedad; ?></span>
                </span>
            </div>
            <div class="fila">
                <span class="label">Tienda</span>
                <span class="valor"><?php echo $tienda; ?></span>
            </div>
        </div>

        <!-- VENTAS -->
        <div class="seccion">
            <div class="seccion-titulo">Ventas del mes</div>
            <div class="fila">
                <span class="label">Total vendido</span>
                <span class="valor">S/ <?php echo number_format($ventas_mes, 2); ?></span>
            </div>
            <div class="fila">
                <span class="label">Nivel alcanzado</span>
                <span class="valor"><?php echo $nivel_icon . " " . $nivel_ventas; ?></span>
            </div>
        </div>

        <hr class="divider">

        <!-- DESGLOSE -->
        <div class="seccion">
            <div class="seccion-titulo">Desglose de bonificación</div>
            <div class="desglose-item">
                <span class="concepto">Bono base (<?php echo $porcentaje_bono; ?>% de ventas)</span>
                <span class="monto">S/ <?php echo number_format($bono_base, 2); ?></span>
            </div>
            <div class="desglose-item">
                <span class="concepto">Bono antigüedad (<?php echo $antiguedad; ?> año(s))</span>
                <span class="monto">S/ <?php echo number_format($bono_antiguedad, 2); ?></span>
            </div>
        </div>

        <!-- TOTAL -->
        <div class="total-box">
            <div class="total-label">Bono total<br>a pagar</div>
            <div class="total-monto">S/ <?php echo number_format($bono_total, 2); ?></div>
        </div>

    </div>

    <!-- FOOTER -->
    <div class="footer">
        <p>SENATI · CFP Arequipa · Backend Developer Web</p>
    </div>

</div>
</body>
</html>