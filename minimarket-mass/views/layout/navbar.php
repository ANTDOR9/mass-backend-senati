<?php $u = usuarioActual(); ?>
<nav style="background:#0066B3;color:#fff;padding:12px 24px;display:flex;align-items:center;justify-content:space-between;font-family:Arial,sans-serif;box-shadow:0 2px 8px rgba(0,0,0,0.15);">

    <div style="font-weight:800;font-size:16px;letter-spacing:.5px;display:flex;align-items:center;gap:8px;">
        🛒 MASS · Sistema de Caja
    </div>

    <div style="display:flex;align-items:center;gap:20px;font-size:13px;">

        <div style="text-align:right;line-height:1.5;">
            <div style="font-weight:700;font-size:14px;">
                👤 <?= htmlspecialchars($u['nombre']) ?>
                <span style="background:rgba(255,255,255,0.2);padding:2px 8px;border-radius:20px;font-size:12px;margin-left:6px;">
                    <?= htmlspecialchars(ucfirst($u['rol'])) ?>
                </span>
            </div>
            <?php if (!empty($u['ultimo_acceso'])): ?>
            <div style="font-size:11px;opacity:0.75;">
                🕐 Último acceso: <?= htmlspecialchars($u['ultimo_acceso']) ?>
            </div>
            <?php endif; ?>
        </div>

        <a href="index.php?accion=logout"
           style="background:#FFB81C;color:#000;padding:7px 16px;border-radius:7px;text-decoration:none;font-weight:700;font-size:13px;white-space:nowrap;">
            Salir
        </a>
    </div>
</nav>