<?php
/*
 * ============================================
 * BOLETA DE PAGO - MINIMARKET MASS
 * Trabajador: Carlos Eduardo Mamani Quispe
 * Periodo: Mayo 2026
 * Autor: Anthony Dorian [Tu apellido aquí]
 * ============================================
 */

/* -------------------------------------------
 * 1. DATOS DEL TRABAJADOR
 * ------------------------------------------- */
$nombre          = "Carlos Eduardo Mamani Quispe";
$dni             = "74521893";
$cargo           = "Jefe de almacén";
$tienda          = "Mass Cayma";
$periodo         = "Mayo 2026";
$dias_trabajados = 30;

/* -------------------------------------------
 * 2. INGRESOS DEL TRABAJADOR
 * ------------------------------------------- */
$sueldo_base      = 2850.00;
$asig_familiar    = 102.50;
$horas_extras     = 12;
$valor_hora_extra = 18.50;

/* -------------------------------------------
 * 3. TASAS DE DESCUENTO
 * ------------------------------------------- */
$tasa_afp     = 0.13;
$tasa_renta   = 0.08;
$tasa_essalud = 0.09;

/* -------------------------------------------
 * 4. CÁLCULOS OBLIGATORIOS (los 8 valores)
 * ------------------------------------------- */
$pago_horas_extras = $horas_extras * $valor_hora_extra;
$total_ingresos    = $sueldo_base + $asig_familiar + $pago_horas_extras;
$descuento_afp     = $total_ingresos * $tasa_afp;
$descuento_renta   = $total_ingresos * $tasa_renta;
$total_descuentos  = $descuento_afp + $descuento_renta;
$sueldo_neto       = $total_ingresos - $total_descuentos;

/* -------------------------------------------
 * 5. RETOS BONUS
 * ------------------------------------------- */
$essalud_empleador   = $sueldo_base * $tasa_essalud;
$costo_total_empresa = $total_ingresos + $essalud_empleador;
$fecha_actual        = date("d/m/Y");
$dias_hipoteticos    = 22;
$sueldo_proporcional = ($sueldo_base / $dias_trabajados) * $dias_hipoteticos;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boleta de Pago — <?php echo $nombre; ?></title>
    <link rel="icon" type="image/png" href="img/favicon.png">
    <link rel="stylesheet" href="css/boleta.css">
</head>
<body>

<div class="boleta">

    <!-- CABECERA -->
    <div class="cabecera">
        <div class="cabecera-izq">
            <img src="img/logo_mass.png" alt="Logo Minimarket Mass" class="logo-mass">
            <div class="cabecera-titulo">
                <h1>Boleta de Pago</h1>
                <p>Tienda: <?php echo $tienda; ?></p>
            </div>
        </div>
        <div class="cabecera-der">
            <div class="periodo"><?php echo $periodo; ?></div>
            <div class="fecha">Emitida: <?php echo $fecha_actual; ?></div>
        </div>
    </div>

    <!-- PERFIL DEL TRABAJADOR -->
    <div class="perfil">
        <img src="img/perfil.jpg" alt="Foto de <?php echo $nombre; ?>" class="perfil-foto">
        <div class="perfil-info">
            <h2><?php echo $nombre; ?></h2>
            <p>DNI: <?php echo $dni; ?></p>
            <div class="perfil-badges">
                <span class="badge"><?php echo $cargo; ?></span>
                <span class="badge gris"><?php echo $tienda; ?></span>
            </div>
        </div>
    </div>

    <!-- DATOS RÁPIDOS -->
    <div class="datos-rapidos">
        <div class="dato-rapido">
            <label>Días trabajados</label>
            <span><?php echo $dias_trabajados; ?> días</span>
        </div>
        <div class="dato-rapido">
            <label>Horas extras</label>
            <span><?php echo $horas_extras; ?> hrs</span>
        </div>
        <div class="dato-rapido">
            <label>Valor por hora</label>
            <span>S/ <?php echo number_format($valor_hora_extra, 2); ?></span>
        </div>
        <div class="dato-rapido">
            <label>Periodo</label>
            <span><?php echo $periodo; ?></span>
        </div>
    </div>

    <!-- CUERPO -->
    <div class="cuerpo">

        <!-- INGRESOS -->
        <div class="seccion">
            <div class="seccion-header ingresos">Ingresos</div>
            <table>
                <tr class="fila-ingreso">
                    <td>Sueldo base</td>
                    <td class="monto">S/ <?php echo number_format($sueldo_base, 2); ?></td>
                </tr>
                <tr class="fila-ingreso">
                    <td>Asignación familiar</td>
                    <td class="monto">S/ <?php echo number_format($asig_familiar, 2); ?></td>
                </tr>
                <tr class="fila-ingreso">
                    <td>Horas extras (<?php echo $horas_extras; ?> × S/ <?php echo number_format($valor_hora_extra, 2); ?>)</td>
                    <td class="monto">S/ <?php echo number_format($pago_horas_extras, 2); ?></td>
                </tr>
                <tr class="fila-total ingresos">
                    <td><strong>Total ingresos</strong></td>
                    <td class="monto"><strong>S/ <?php echo number_format($total_ingresos, 2); ?></strong></td>
                </tr>
            </table>
        </div>

        <!-- DESCUENTOS -->
        <div class="seccion">
            <div class="seccion-header descuentos">Descuentos</div>
            <table>
                <tr class="fila-descuento">
                    <td data-tooltip="Aporte obligatorio al sistema de pensiones">AFP (<?php echo ($tasa_afp * 100); ?>%)</td>
                    <td class="monto">S/ <?php echo number_format($descuento_afp, 2); ?></td>
                </tr>
                <tr class="fila-descuento">
                    <td data-tooltip="Cálculo simplificado — régimen general">Impuesto a la Renta (<?php echo ($tasa_renta * 100); ?>%)</td>
                    <td class="monto">S/ <?php echo number_format($descuento_renta, 2); ?></td>
                </tr>
                <tr class="fila-total descuentos">
                    <td><strong>Total descuentos</strong></td>
                    <td class="monto"><strong>S/ <?php echo number_format($total_descuentos, 2); ?></strong></td>
                </tr>
            </table>
        </div>

        <!-- SUELDO NETO -->
        <div class="sueldo-neto">
            <span class="etiqueta">Sueldo neto a pagar</span>
            <span class="valor" id="sueldo-neto-valor" data-valor="<?php echo $sueldo_neto; ?>">
                S/ <?php echo number_format($sueldo_neto, 2); ?>
            </span>
        </div>

        <!-- BONUS -->
        <div class="bonus">
            <h3>Información adicional</h3>
            <table>
                <tr>
                    <td>EsSalud a cargo del empleador (<?php echo ($tasa_essalud * 100); ?>% del sueldo base)</td>
                    <td class="monto">S/ <?php echo number_format($essalud_empleador, 2); ?></td>
                </tr>
                <tr>
                    <td><strong>Costo total para la empresa</strong></td>
                    <td class="monto"><strong>S/ <?php echo number_format($costo_total_empresa, 2); ?></strong></td>
                </tr>
                <tr>
                    <td>Sueldo proporcional a <?php echo $dias_hipoteticos; ?> días trabajados</td>
                    <td class="monto">S/ <?php echo number_format($sueldo_proporcional, 2); ?></td>
                </tr>
            </table>
        </div>

        <!-- BOTÓN IMPRIMIR -->
        <div style="text-align:center; margin-bottom: 8px;">
            <button id="btn-imprimir" style="
                background: #E30613; color: white; border: none;
                padding: 10px 28px; border-radius: 8px;
                font-size: 14px; font-weight: 700;
                cursor: pointer; letter-spacing: 1px;
            ">IMPRIMIR BOLETA</button>
        </div>

    </div><!-- /cuerpo -->

    <footer>
        Documento generado automáticamente · SENATI CFP Arequipa · Backend Developer Web &nbsp;|&nbsp; Tarea T01 · HT-01
    </footer>

</div><!-- /boleta -->

<script src="js/boleta.js"></script>
</body>
</html>
