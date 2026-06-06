# Avance en Clase

Archivos desarrollados durante las sesiones presenciales y virtuales del curso Backend Developer Web.

---

## PRACTICAS 1 — Introducción a PHP

Primeros ejercicios con PHP puro. Se trabajaron conceptos básicos como variables, condicionales, funciones y salida HTML desde PHP. Archivos destacados:

- `saludo_mass.php` — primer script de bienvenida
- `boleta_igv.php` — cálculo de IGV sobre productos
- `ficha_producto_anthony.php` — ficha de producto con datos hardcodeados
- `descuento_mass.php` — lógica de descuentos por cantidad
- `info.php` — página phpinfo() del entorno Laragon

## PRACTICAS 2 — Introducción al patrón MVC

Se introdujo la arquitectura MVC separando el proyecto en carpetas `models/`, `controllers/`, `views/` y `public/`. En esta etapa los datos todavía eran hardcodeados en un array dentro del `ProductoRepository`. Archivos destacados:

- `models/Producto.php` — entidad con atributos privados, getters y métodos de negocio (IGV, stock)
- `models/ProductoRepository.php` — repositorio con datos en array, preparado para migrar a MySQL
- `controllers/ProductoController.php` — orquesta model y view sin generar HTML
- `public/index.php` — Front Controller con router por `?ruta=`
- `views/productos/lista.php` — tabla HTML con los productos del catálogo

> A partir de PRACTICAS 2 el sistema se conectó a MySQL con PDO. Ver `minimarket-mass/` para el sistema completo.
