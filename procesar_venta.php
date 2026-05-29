<?php
// ============================================
// EJERCICIO INTEGRADOR - procesar_venta.php
// Sistema Mass - Sesión 2 - Backend Developer Web SENATI
// ============================================

// --- DATOS DEL CLIENTE ---
$cliente_nombre = "Anthony Dorly Huilahuaña Chata";
$cliente_dni    = "72345678";
$cliente_tipo   = "frecuente"; // regular / frecuente / vip

// --- PRODUCTOS ---
$productos = [
    ["nombre" => "Inca Kola 1.5L",     "categoria" => "bebidas",   "precio" => 4.50, "cantidad" => 3],
    ["nombre" => "Arroz Costeño 1kg",  "categoria" => "abarrotes", "precio" => 3.80, "cantidad" => 2],
    ["nombre" => "Leche Gloria 1L",    "categoria" => "lacteos",   "precio" => 5.20, "cantidad" => 4],
    ["nombre" => "Pan de molde Bimbo", "categoria" => "panaderia", "precio" => 6.90, "cantidad" => 1],
];

// --- MÉTODO DE PAGO ---
$metodo_pago = "yape"; // efectivo / yape / plin / tarjeta

// ============================================
// BLOQUE 1: VALIDACIÓN DE DNI
// ============================================
if (strlen($cliente_dni) !== 8 || !ctype_digit($cliente_dni)) {
    echo "<!DOCTYPE html><html><body style='font-family:Arial;display:flex;justify-content:center;padding:40px'>
    <div style='background:#fff3cd;border:2px solid #ffc107;padding:20px;border-radius:8px;max-width:400px'>
    <h3 style='color:#856404;margin:0'>⚠️ DNI Inválido</h3>
    <p style='color:#856404'>El DNI debe tener exactamente 8 dígitos numéricos.</p>
    </div></body></html>";
    exit;
}

// ============================================
// BLOQUE 2 y 3: IGV Y SUBTOTALES POR PRODUCTO
// ============================================
$detalle       = [];
$gran_subtotal = 0;
$gran_igv      = 0;

foreach ($productos as $p) {
    switch ($p["categoria"]) {
        case "abarrotes":
        case "bebidas":
        case "lacteos":
        case "limpieza":
        case "aseo personal":
            $tasa_igv = 0.18;
            break;
        case "panaderia":
        case "frutas":
        case "verduras":
            $tasa_igv = 0;
            break;
        default:
            $tasa_igv = 0.18;
    }

    $subtotal       = $p["precio"] * $p["cantidad"];
    $igv_producto   = $subtotal * $tasa_igv;
    $total_producto = $subtotal + $igv_producto;

    $gran_subtotal += $subtotal;
    $gran_igv      += $igv_producto;

    $detalle[] = [
        "nombre"         => $p["nombre"],
        "precio"         => $p["precio"],
        "cantidad"       => $p["cantidad"],
        "tasa_igv"       => $tasa_igv,
        "igv_producto"   => $igv_producto,
        "subtotal"       => $subtotal,
        "total_producto" => $total_producto,
    ];
}

$total_bruto = $gran_subtotal + $gran_igv;

// ============================================
// BLOQUE 4: DESCUENTO POR MONTO
// ============================================
if ($total_bruto < 30) {
    $pct_monto = 0;
} elseif ($total_bruto < 100) {
    $pct_monto = 5;
} elseif ($total_bruto < 200) {
    $pct_monto = 10;
} else {
    $pct_monto = 15;
}

// ============================================
// BLOQUE 5: DESCUENTO POR TIPO DE CLIENTE
// ============================================
switch ($cliente_tipo) {
    case "frecuente":
        $pct_cliente = 2;
        break;
    case "vip":
        $pct_cliente = 5;
        break;
    default:
        $pct_cliente = 0;
}

$pct_total       = $pct_monto + $pct_cliente;
$monto_descuento = $total_bruto * ($pct_total / 100);
$total_final     = $total_bruto - $monto_descuento;

// ============================================
// BLOQUE 6: MÉTODO DE PAGO
// ============================================
$advertencia_pago = "";
switch ($metodo_pago) {
    case "yape":
    case "plin":
        $instruccion_pago = "📱 Mostrar QR del comercio";
        break;
    case "tarjeta":
        $instruccion_pago = "💳 Insertar tarjeta en POS";
        break;
    default:
        $instruccion_pago = "💵 Pago en efectivo — exacto preferido";
        if ($total_final > 500) {
            $advertencia_pago = "⚠️ Se sugiere otro método para montos altos";
        }
}

// ============================================
// BLOQUE 7: SALUDO SEGÚN HORA
// ============================================
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Venta - Mass</title>
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
            max-width: 560px;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(30,30,170,0.15);
            animation: fadeUp 0.5s ease both;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .header {
            background: var(--mass-yellow);
            padding: 28px 32px 20px;
            text-align: center;
        }
        .header img {
            height: 72px;
            width: auto;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }
        .header-sub {
            margin-top: 8px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--mass-blue);
            opacity: 0.8;
        }

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
            color: rgba(255,255,255,0.65);
        }
        .stripe strong {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: var(--mass-yellow);
        }

        .saludo {
            background: #EEF0FF;
            border-left: 4px solid var(--mass-blue);
            padding: 12px 32px;
            font-size: 14px;
            font-weight: 500;
            color: var(--mass-blue);
        }

        .body { padding: 24px 32px; }

        .seccion { margin-bottom: 22px; }
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

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        thead tr { background: var(--mass-blue); }
        thead th {
            padding: 9px 10px;
            text-align: left;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.8);
        }
        tbody tr:nth-child(even) { background: var(--mass-light); }
        tbody td {
            padding: 8px 10px;
            color: #374151;
            border-bottom: 1px solid #F3F4F6;
        }
        tbody td.monto { font-weight: 600; color: var(--mass-dark); text-align: right; }

        .resumen-item {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            font-size: 14px;
            border-bottom: 1px dashed #E5E7EB;
        }
        .resumen-item:last-child { border-bottom: none; }
        .resumen-item .r-label   { color: var(--mass-gray); }
        .resumen-item .r-valor   { font-weight: 600; }
        .resumen-item .r-descuento { color: #16a34a; font-weight: 700; }

        .divider {
            border: none;
            border-top: 2px dashed #E5E7EB;
            margin: 20px 0;
        }

        .total-box {
            background: var(--mass-blue);
            border-radius: 12px;
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }
        .total-label {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.75);
        }
        .total-monto {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 34px;
            font-weight: 900;
            color: var(--mass-yellow);
        }

        .pago-box {
            background: var(--mass-light);
            border: 2px solid var(--mass-blue);
            border-radius: 10px;
            padding: 14px 20px;
            text-align: center;
            font-size: 14px;
            font-weight: 600;
            color: var(--mass-blue);
            margin-bottom: 8px;
        }
        .advertencia {
            background: #FFF9E6;
            border: 1px solid var(--mass-yellow);
            border-radius: 8px;
            padding: 10px 16px;
            font-size: 13px;
            color: #92600A;
            text-align: center;
            margin-bottom: 8px;
        }

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
    </style>
</head>
<body>
<div class="ticket">

    <div class="header">
        <img src="logo_mass.png" alt="Mass Minimarket">
        <div class="header-sub">Comprobante de Venta</div>
    </div>

    <div class="stripe">
        <span>Mass Arequipa</span>
        <strong><?php echo date("d/m/Y H:i:s"); ?></strong>
    </div>

    <div class="saludo">
        👋 <?php echo $saludo . ", <strong>" . $cliente_nombre . "</strong>"; ?>
    </div>

    <div class="body">

        <div class="seccion">
            <div class="seccion-titulo">Datos del cliente</div>
            <div class="fila">
                <span class="label">Nombre</span>
                <span class="valor"><?php echo $cliente_nombre; ?></span>
            </div>
            <div class="fila">
                <span class="label">DNI</span>
                <span class="valor"><?php echo $cliente_dni; ?></span>
            </div>
            <div class="fila">
                <span class="label">Tipo de cliente</span>
                <span class="valor"><span class="badge"><?php echo ucfirst($cliente_tipo); ?></span></span>
            </div>
        </div>

        <div class="seccion">
            <div class="seccion-titulo">Detalle de productos</div>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>P.Unit</th>
                        <th>Cant.</th>
                        <th>IGV</th>
                        <th style="text-align:right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detalle as $d): ?>
                    <tr>
                        <td><?php echo $d["nombre"]; ?></td>
                        <td>S/ <?php echo number_format($d["precio"], 2); ?></td>
                        <td><?php echo $d["cantidad"]; ?></td>
                        <td><?php echo ($d["tasa_igv"] * 100); ?>%</td>
                        <td class="monto">S/ <?php echo number_format($d["total_producto"], 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <hr class="divider">

        <div class="seccion">
            <div class="seccion-titulo">Resumen</div>
            <div class="resumen-item">
                <span class="r-label">Subtotal</span>
                <span class="r-valor">S/ <?php echo number_format($gran_subtotal, 2); ?></span>
            </div>
            <div class="resumen-item">
                <span class="r-label">Total IGV</span>
                <span class="r-valor">S/ <?php echo number_format($gran_igv, 2); ?></span>
            </div>
            <div class="resumen-item">
                <span class="r-label">Descuento por monto (<?php echo $pct_monto; ?>%)</span>
                <span class="r-descuento">— aplicado</span>
            </div>
            <div class="resumen-item">
                <span class="r-label">Descuento cliente <?php echo ucfirst($cliente_tipo); ?> (<?php echo $pct_cliente; ?>%)</span>
                <span class="r-descuento">— aplicado</span>
            </div>
            <div class="resumen-item">
                <span class="r-label">Total descuento (<?php echo $pct_total; ?>%)</span>
                <span class="r-descuento">- S/ <?php echo number_format($monto_descuento, 2); ?></span>
            </div>
        </div>

        <div class="total-box">
            <div class="total-label">Total<br>a pagar</div>
            <div class="total-monto">S/ <?php echo number_format($total_final, 2); ?></div>
        </div>

        <div class="pago-box"><?php echo $instruccion_pago; ?></div>

        <?php if ($advertencia_pago): ?>
        <div class="advertencia"><?php echo $advertencia_pago; ?></div>
        <?php endif; ?>

    </div>

    <div class="footer">
        <p>SENATI · CFP Arequipa · Backend Developer Web</p>
    </div>

</div>
</body>
</html>