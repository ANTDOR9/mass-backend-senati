<?php
declare(strict_types=1);

function requiereLogin(): void {
    if (!isset($_SESSION['usuario'])) {
        header('Location: index.php?accion=login');
        exit;
    }
}

function usuarioActual(): ?array {
    return $_SESSION['usuario'] ?? null;
}

function requiereRol(string $rol): void {
    requiereLogin();
    if (usuarioActual()['rol'] !== $rol) {
        http_response_code(403);
        echo '<div style="font-family:Arial;margin:40px;padding:20px;background:#fef2f2;border:1px solid #f3c2c2;border-radius:8px;color:#b91c1c;">';
        echo '<h2>⛔ Acceso denegado</h2>';
        echo '<p>No tienes permisos para ver esta página.</p>';
        echo '<a href="index.php?accion=catalogo">← Volver al catálogo</a>';
        echo '</div>';
        exit;
    }
}
