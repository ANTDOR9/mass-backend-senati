<?php
$u    = usuarioActual();
$modo = $u['rol'] === 'admin' ? '⚙️ Modo administrador' : '🏪 Caja';
?>
<div style="background:#0066B3;color:#fff;padding:10px 20px;display:flex;justify-content:space-between;align-items:center;font-family:Arial,sans-serif;">
    <div>
        <strong><?= htmlspecialchars($u['nombre']) ?></strong>
        <span style="margin-left:12px;background:rgba(255,255,255,0.2);padding:3px 10px;border-radius:20px;font-size:13px;">
            <?= htmlspecialchars($modo) ?>
        </span>
        <span style="margin-left:12px;font-size:13px;opacity:0.85;">
            📍 <?= htmlspecialchars($u['tienda']) ?>
        </span>
        <?php if (!empty($u['ultimo_acceso'])): ?>
        <span style="margin-left:16px;font-size:12px;opacity:0.75;">
            🕐 Último acceso: <?= htmlspecialchars($u['ultimo_acceso']) ?>
        </span>
        <?php endif; ?>
    </div>
    <a href="index.php?accion=logout"
       style="background:#FFB81C;color:#000;padding:7px 16px;border-radius:8px;text-decoration:none;font-weight:700;font-size:13px;">
        Salir
    </a>
</div>
