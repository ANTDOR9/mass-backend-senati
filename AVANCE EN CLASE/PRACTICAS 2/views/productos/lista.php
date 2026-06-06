<?php require_once __DIR__ . '/../layout/header.php'; ?>

<h1>Catálogo Minimarket Mass</h1>
<p>Total de productos: <strong><?= count($productos) ?></strong></p>

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Precio con IGV</th>
            <th>Stock</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productos as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p->getCodigo()) ?></td>
            <td><?= htmlspecialchars($p->getNombre()) ?></td>
            <td>S/ <?= number_format($p->getPrecio(), 2) ?></td>
            <td>S/ <?= number_format($p->precioConIGV(), 2) ?></td>
            <td><?= $p->getStock() ?> unidades</td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>