<?php $accionActual = $_GET['accion'] ?? 'catalogo'; ?>
<aside style="background:#0c1f33;color:#cdd9e6;width:190px;flex:0 0 190px;padding:20px 12px;font-family:Arial,sans-serif;min-height:calc(100vh - 96px);border-right:1px solid #11304d;">

    <p style="font-size:10px;color:#4a6a8a;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:0 11px;margin-bottom:10px;">
        Navegación
    </p>

    <a href="index.php?accion=catalogo"
       style="display:flex;align-items:center;gap:10px;padding:10px 13px;border-radius:8px;margin-bottom:4px;text-decoration:none;font-size:13.5px;font-weight:<?= $accionActual === 'catalogo' ? '700' : '400' ?>;
              background:<?= $accionActual === 'catalogo' ? 'rgba(0,102,179,0.35)' : 'transparent' ?>;
              color:<?= $accionActual === 'catalogo' ? '#fff' : '#9db8d2' ?>;
              border-left:3px solid <?= $accionActual === 'catalogo' ? '#FFB81C' : 'transparent' ?>;">
        📦 Catálogo
    </a>

    <a href="index.php?accion=nuevo-producto"
       style="display:flex;align-items:center;gap:10px;padding:10px 13px;border-radius:8px;margin-bottom:4px;text-decoration:none;font-size:13.5px;font-weight:<?= $accionActual === 'nuevo-producto' ? '700' : '400' ?>;
              background:<?= $accionActual === 'nuevo-producto' ? 'rgba(0,102,179,0.35)' : 'transparent' ?>;
              color:<?= $accionActual === 'nuevo-producto' ? '#fff' : '#9db8d2' ?>;
              border-left:3px solid <?= $accionActual === 'nuevo-producto' ? '#FFB81C' : 'transparent' ?>;">
        ➕ Nuevo producto
    </a>

    <a href="index.php?accion=reporte-pdf" target="_blank"
       style="display:flex;align-items:center;gap:10px;padding:10px 13px;border-radius:8px;margin-bottom:4px;text-decoration:none;font-size:13.5px;font-weight:400;color:#9db8d2;">
        🧾 Reporte PDF
    </a>

    <?php if (usuarioActual()['rol'] === 'admin'): ?>
    <a href="index.php?accion=panel-admin"
       style="display:flex;align-items:center;gap:10px;padding:10px 13px;border-radius:8px;margin-bottom:4px;text-decoration:none;font-size:13.5px;font-weight:<?= $accionActual === 'panel-admin' ? '700' : '400' ?>;
              background:<?= $accionActual === 'panel-admin' ? 'rgba(0,102,179,0.35)' : 'transparent' ?>;
              color:<?= $accionActual === 'panel-admin' ? '#fff' : '#9db8d2' ?>;
              border-left:3px solid <?= $accionActual === 'panel-admin' ? '#FFB81C' : 'transparent' ?>;">
        ⚙️ Panel admin
    </a>
    <?php endif; ?>

    <div style="padding:12px 11px 0;border-top:1px solid #1a3a5c;margin-top:30px;">
        <p style="font-size:11px;color:#4a6a8a;margin:0;">
            <?= htmlspecialchars(usuarioActual()['tienda'] ?? '') ?>
        </p>
    </div>
</aside>
