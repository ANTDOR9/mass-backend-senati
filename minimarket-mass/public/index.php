<?php
declare(strict_types=1);

// La sesión debe arrancar ANTES de cualquier salida al navegador.
session_start();


require_once __DIR__ . '/../helpers/sesion.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/ProductoController.php';

// Enrutamiento simple por ?accion=
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

    case 'catalogo':
        requiereLogin();
        (new ProductoController())->listar();
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

    default:
        http_response_code(404);
        echo '<h1>404 — Ruta no encontrada</h1>';
        echo '<p><a href="index.php">Volver al inicio</a></p>';
        break;
}