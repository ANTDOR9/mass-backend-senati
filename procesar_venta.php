<?php
// ============================================
// EJERCICIO INTEGRADOR - procesar_venta.php
// Sistema Mass - Sesión 2
// ============================================

// --- DATOS DEL CLIENTE ---
$cliente_nombre = "María Mamani";
$cliente_dni = "72345678";
$cliente_tipo = "frecuente"; // regular / frecuente / vip

// --- PRODUCTOS (nombre, categoría, precio unitario, cantidad) ---
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
    echo "<p style='color:red'>ERROR: DNI inválido.</p>";
    exit;
}

// ============================================
// BLOQUE 2 y 3: IGV Y SUBTOTALES POR PRODUCTO
// ============================================
$detalle = [];
$gran_subtotal = 0;
$gran_igv = 0;

foreach ($productos as $p) {

    // IGV según categoría
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

$pct_total      = $pct_monto + $pct_cliente;
$monto_descuento = $total_bruto * ($pct_total / 100);
$total_final    = $total_bruto - $monto_descuento;

// ============================================
// BLOQUE 6: MÉTODO DE PAGO
// ============================================
switch ($metodo_pago) {
    case "yape":
    case "plin":
        $instruccion_pago = "Mostrar QR del comercio";
        break;
    case "tarjeta":
        $instruccion_pago = "Insertar tarjeta en POS";
        break;
    default:
        $instruccion_pago = "Pago en efectivo - exacto preferido";
        if ($total_final > 500) {
            $instruccion_pago .= " ⚠️ Se sugiere otro método para montos altos";
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
    <title>Comprobante - Mass</title>
    <style>
        body { font-family: Arial, sans-serif; background:#f4f4f4; display:flex; justify-content:center; padding:30px; }
        .ticket { background:white; width:520px; padding:30px; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,0.1); }
        .header { text-align:center; border-bottom:3px solid #e30613; padding-bottom:15px; margin-bottom:20px; }
        .logo { font-size:42px; font-weight:900; color:#e30613; letter-spacing:4px; }
        .header p { margin:4px 0; color:#555; font-size:13px; }
        .saludo { background:#fff3f3; border-left:4px solid #e30613; padding:10px 15px; margin-bottom:20px; font-size:14px; }
        .seccion h3 { font-size:12px; text-transform:uppercase; color:#999; border-bottom:1px solid #eee; padding-bottom:4px; margin-bottom:8px; }
        .fila { display:flex; justify-content:space-between; font-size:13px; padding:3px 0; }
        table { width:100%; border-collapse:collapse; font-size:13px; margin-bottom:16px; }
        th { background:#e30613; color:white; padding:7px; text-align:left; font-size:12px; }
        td { padding:6px 7px; border-bottom:1px solid #f0f0f0; }
        .total-box { background:#e30613; color:white; padding:15px 20px; border-radius:6px; display:flex; justify-content:space-between; font-size:18px; font-weight:bold; margin-top:16px; }
        .pago-box { background:#f9f9f9; border:1px solid #ddd; border-radius:6px; padding:12px 16px; margin-top:12px; font-size:14px; text-align:center; }
        .footer { text-align:center; margin-top:20px; font-size:11px; color:#aaa; }
    </style>
</head>
<body>
<div class="ticket">

    <div class="header">
        <div class="logo">MASS</div>
        <p>Minimarket · Arequipa</p>
        <p>Comprobante de Venta</p>
        <p><?php echo date("d/m/Y H:i:s"); ?></p>
    </div>

    <div class="saludo"><?php echo $saludo . ", " . $cliente_nombre; ?> 👋</div>

    <div class="seccion">
        <h3>Cliente</h3>
        <div class="fila"><span>Nombre</span><span><?php echo $cliente_nombre; ?></span></div>
        <div class="fila"><span>DNI</span><span><?php echo $cliente_dni; ?></span></div>
        <div class="fila"><span>Tipo</span><span><?php echo ucfirst($cliente_tipo); ?></span></div>
    </div>

    <div class="seccion">
        <h3>Detalle de productos</h3>
        <table>
            <tr>
                <th>Producto</th>
                <th>P.Unit</th>
                <th>Cant.</th>
                <th>IGV</th>
                <th>Total</th>
            </tr>
            <?php foreach ($detalle as $d): ?>
            <tr>
                <td><?php echo $d["nombre"]; ?></td>
                <td>S/ <?php echo number_format($d["precio"], 2); ?></td>
                <td><?php echo $d["cantidad"]; ?></td>
                <td><?php echo ($d["tasa_igv"] * 100); ?>%</td>
                <td>S/ <?php echo number_format($d["total_producto"], 2); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="seccion">
        <h3>Resumen</h3>
        <div class="fila"><span>Subtotal</span><span>S/ <?php echo number_format($gran_subtotal, 2); ?></span></div>
        <div class="fila"><span>Total IGV</span><span>S/ <?php echo number_format($gran_igv, 2); ?></span></div>
        <div class="fila"><span>Descuento por monto (<?php echo $pct_monto; ?>%)</span><span>-</span></div>
        <div class="fila"><span>Descuento por cliente <?php echo ucfirst($cliente_tipo); ?> (<?php echo $pct_cliente; ?>%)</span><span>-</span></div>
        <div class="fila"><span>Total descuento (<?php echo $pct_total; ?>%)</span><span>- S/ <?php echo number_format($monto_descuento, 2); ?></span></div>
    </div>

    <div class="total-box">
        <span>TOTAL A PAGAR</span>
        <span>S/ <?php echo number_format($total_final, 2); ?></span>
    </div>

    <div class="pago-box">
        💳 <?php echo $instruccion_pago; ?>
    </div>

    <div class="footer">
        SENATI · CFP Arequipa · Backend Developer Web<br>
        Generado el <?php echo date("d/m/Y \a \l\a\s H:i"); ?>
    </div>

</div>
</body>
</html>