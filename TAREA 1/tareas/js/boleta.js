/*
 * ============================================
 * BOLETA DE PAGO — MINIMARKET MASS
 * JavaScript: efectos visuales y animaciones
 * Autor: Anthony Dorian
 * ============================================
 */

// Espera a que el DOM esté listo
document.addEventListener('DOMContentLoaded', function () {

    /* -------------------------------------------
     * 1. CONTADOR ANIMADO EN EL SUELDO NETO
     * Hace que el número cuente desde 0 hasta el valor real
     * ------------------------------------------- */
    const elementoNeto = document.getElementById('sueldo-neto-valor');

    if (elementoNeto) {
        // Lee el valor real desde el atributo data-valor
        const valorFinal = parseFloat(elementoNeto.getAttribute('data-valor'));
        const duracion   = 1500; // milisegundos
        const pasos      = 60;
        const incremento = valorFinal / pasos;
        let valorActual  = 0;
        let paso         = 0;

        const intervalo = setInterval(function () {
            paso++;
            valorActual += incremento;

            if (paso >= pasos) {
                valorActual = valorFinal;
                clearInterval(intervalo);
            }

            // Formatea con 2 decimales y separador de miles
            elementoNeto.textContent = 'S/ ' + valorActual.toLocaleString('es-PE', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }, duracion / pasos);
    }

    /* -------------------------------------------
     * 2. HIGHLIGHT EN FILAS AL HACER HOVER
     * Resalta visualmente la fila activa
     * ------------------------------------------- */
    const filas = document.querySelectorAll('tr.fila-ingreso, tr.fila-descuento');

    filas.forEach(function (fila) {
        fila.addEventListener('mouseenter', function () {
            fila.style.transform = 'scale(1.01)';
            fila.style.transition = 'transform 0.2s ease';
            fila.style.boxShadow  = '0 4px 12px rgba(0,0,0,0.08)';
            fila.style.position   = 'relative';
            fila.style.zIndex     = '1';
        });

        fila.addEventListener('mouseleave', function () {
            fila.style.transform = 'scale(1)';
            fila.style.boxShadow = 'none';
            fila.style.zIndex    = '0';
        });
    });

    /* -------------------------------------------
     * 3. TOOLTIP AL PASAR POR LOS PORCENTAJES
     * Muestra info extra en AFP e Impuesto Renta
     * ------------------------------------------- */
    const celdasConTooltip = document.querySelectorAll('[data-tooltip]');

    celdasConTooltip.forEach(function (celda) {
        // Crea el elemento tooltip
        const tooltip = document.createElement('div');
        tooltip.textContent = celda.getAttribute('data-tooltip');
        tooltip.style.cssText = `
            position: absolute;
            background: #1a1a1a;
            color: #fff;
            font-size: 11px;
            padding: 5px 10px;
            border-radius: 6px;
            white-space: nowrap;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.2s ease;
            z-index: 100;
            margin-top: -30px;
        `;
        document.body.appendChild(tooltip);

        celda.style.position = 'relative';
        celda.style.cursor   = 'help';

        celda.addEventListener('mouseenter', function (e) {
            tooltip.style.opacity = '1';
            tooltip.style.left    = e.pageX + 'px';
            tooltip.style.top     = (e.pageY - 35) + 'px';
        });

        celda.addEventListener('mousemove', function (e) {
            tooltip.style.left = e.pageX + 'px';
            tooltip.style.top  = (e.pageY - 35) + 'px';
        });

        celda.addEventListener('mouseleave', function () {
            tooltip.style.opacity = '0';
        });
    });

    /* -------------------------------------------
     * 4. BOTÓN IMPRIMIR
     * Abre el diálogo de impresión del navegador
     * ------------------------------------------- */
    const btnImprimir = document.getElementById('btn-imprimir');
    if (btnImprimir) {
        btnImprimir.addEventListener('click', function () {
            window.print();
        });
    }

});
