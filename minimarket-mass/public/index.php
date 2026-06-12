<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/../helpers/sesion.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/ProductoController.php';
require_once __DIR__ . '/../controllers/ReporteController.php';

$accion = $_GET['accion'] ?? 'catalogo';
$auth   = new AuthController();

switch ($accion) {

    case 'login':
        $auth->mostrarLogin();
        break;

    case 'procesar-login':
        $auth->procesarLogin();
        break;

    case 'logout':
        $auth->logout();
        break;

    case 'panel-admin':
        requiereRol('admin');
        require __DIR__ . '/../TAREA 5/panel_admin.php';
        break;

    case 'nuevo-producto':
        requiereLogin();
        (new ProductoController())->nuevo();
        break;

    case 'guardar-producto':
        requiereLogin();
        (new ProductoController())->guardar();
        break;

    case 'editar-producto':
        requiereLogin();
        (new ProductoController())->editar();
        break;

    case 'actualizar-producto':
        requiereLogin();
        (new ProductoController())->actualizar();
        break;

    case 'eliminar-producto':
        requiereLogin();
        (new ProductoController())->eliminar();
        break;

    case 'confirmar-eliminar':
        requiereLogin();
        (new ProductoController())->confirmarEliminar();
        break;

    case 'reporte-pdf':
        requiereLogin();
        (new ReporteController())->catalogoPdf();
        break;

    case 'catalogo':
    default:
        requiereLogin();
        (new ProductoController())->listar();
        break;
}
