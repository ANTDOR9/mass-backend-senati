<?php require __DIR__ . '/../views/layout/header.php'; ?>
<?php require __DIR__ . '/../views/auth/barra_usuario.php'; ?>

<div style="margin:40px;">
    <h1>Panel de administración</h1>
    <p>Bienvenido, <strong><?= htmlspecialchars(usuarioActual()['nombre']) ?></strong>.</p>
    <p>Desde aquí puedes gestionar el sistema Minimarket Mass.</p>
    <hr>
    <ul>
        <li><a href="index.php?accion=catalogo">Ver catálogo de productos</a></li>
        <li><a href="index.php?accion=nuevo-producto">Agregar nuevo producto</a></li>
    </ul>
</div>

<?php require __DIR__ . '/../views/layout/footer.php'; ?>
