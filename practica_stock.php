<?php
/*
 * ============================================================
 *  PRÁCTICA DEL DÍA — Control de Stock de Productos
 *  Tema   : Condicionales en PHP (if / elseif / else)
 *  Alumno : ANTHONY DORLY HUILAHUAÑA CHATA
 *  Fecha  : <?php echo date('d/m/Y'); ?>
 * ============================================================
 */

// ── Variables del producto ──────────────────────────────────
$producto = "Inca Kola 1.5L";
$stock    = 7;

// ── Lógica de control de stock ──────────────────────────────
if ($stock === 0) {
    echo $producto . ": AGOTADO - reponer urgente";
} elseif ($stock < 10) {
    echo $producto . ": stock bajo (" . $stock . " unid.) - reponer pronto";
} elseif ($stock < 50) {
    echo $producto . ": stock normal";
} else {
    echo $producto . ": stock alto";
}

/*
 * ── NOTAS DE LA PRÁCTICA ────────────────────────────────────
 *
 *  ¿Qué aprendimos hoy?
 *  ---------------------
 *  1. if         → primera condición que se evalúa
 *  2. elseif     → condición alternativa (puede haber varias)
 *  3. else       → se ejecuta si NINGUNA condición fue true
 *
 *  Operadores usados:
 *  ------------------
 *  ===   Igualdad estricta (valor Y tipo deben coincidir)
 *  <     Menor que
 *
 *  Concatenación:
 *  --------------
 *  El punto (.) une cadenas de texto en PHP
 *  Ejemplo: "Hola" . " Mundo"  →  "Hola Mundo"
 *
 *  ¿Cómo probar distintos casos?
 *  ------------------------------
 *  Cambia el valor de $stock y vuelve a ejecutar:
 *   $stock = 0;   → "AGOTADO"
 *   $stock = 5;   → "stock bajo"
 *   $stock = 25;  → "stock normal"
 *   $stock = 100; → "stock alto"
 * ============================================================
 */
?>