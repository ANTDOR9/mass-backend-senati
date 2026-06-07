<?php
declare(strict_types=1);
require_once __DIR__ . '/../models/ProductoRepository.php';

class ProductoController {

    private ProductoRepository $repo;

    public function __construct() {
        $this->repo = new ProductoRepository();
    }

    public function listar(): void {
        $productos = $this->repo->obtenerTodos();
        require __DIR__ . '/../views/productos/lista.php';
    }

    public function nuevo(): void {
        require __DIR__ . '/../views/productos/crear.php';
    }

    public function guardar(): void {
        $codigo    = trim($_POST['codigo'] ?? '');
        $nombre    = trim($_POST['nombre'] ?? '');
        $marca     = trim($_POST['marca'] ?? '');
        $categoria = (int)  ($_POST['categoria'] ?? 0);
        $precio    = (float)($_POST['precio'] ?? 0);
        $stock     = (int)  ($_POST['stock'] ?? 0);

        if ($codigo === '' || $nombre === '' || $precio <= 0) {
            $error = 'Completa código, nombre y un precio mayor a 0.';
            require __DIR__ . '/../views/productos/crear.php';
            return;
        }

        if ($this->repo->buscarPorCodigo($codigo) !== null) {
            $error = 'Ya existe un producto con ese código de barras.';
            require __DIR__ . '/../views/productos/crear.php';
            return;
        }

        $this->repo->crear([
            'codigo'    => $codigo,
            'nombre'    => $nombre,
            'marca'     => $marca,
            'categoria' => $categoria,
            'precio'    => $precio,
            'stock'     => $stock,
        ]);

        header('Location: index.php?accion=catalogo');
        exit;
    }
}