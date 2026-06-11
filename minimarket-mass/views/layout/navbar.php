<?php $u = usuarioActual(); ?>
<nav style="background:#0066B3;color:#fff;padding:12px 20px;display:flex;align-items:center;justify-content:space-between;font-family:Arial,sans-serif;">
    <div style="font-weight:800;font-size:16px;letter-spacing:.5px;">
        🛒 MASS · Sistema de Caja
    </div>
    <div style="display:flex;align-items:center;gap:14px;font-size:14px;">
        👤 <strong><?= htmlspecialchars($u['nombre']) ?></strong>
        &nbsp;·&nbsp;
        <?= htmlspecialchars(ucfirst($u['rol'])) ?>
        <a href="index.php?accion=logout"
           style="background:#FFB81C;color:#000;padding:6px 14px;border-radius:7px;text-decoration:none;font-weight:700;font-size:13px;">
            Salir
        </a>
    </div>
</nav>
