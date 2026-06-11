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
        $categoria = (int)  ($_POST['categoria'] ?? 1);
        $precio    = (float)($_POST['precio'] ?? 0);
        $stock     = (int)  ($_POST['stock'] ?? 0);

        if ($codigo === '' || strlen($codigo) < 3) {
            $error = 'El código debe tener al menos 3 caracteres.';
            require __DIR__ . '/../views/productos/crear.php';
            return;
        }
        if ($nombre === '' || strlen($nombre) < 3) {
            $error = 'El nombre debe tener al menos 3 caracteres.';
            require __DIR__ . '/../views/productos/crear.php';
            return;
        }
        if ($precio <= 0) {
            $error = 'El precio debe ser mayor a 0.';
            require __DIR__ . '/../views/productos/crear.php';
            return;
        }
        if ($stock < 0) {
            $error = 'El stock no puede ser negativo.';
            require __DIR__ . '/../views/productos/crear.php';
            return;
        }
        if ($this->repo->buscarPorCodigo($codigo) !== null) {
            $error = "Ya existe un producto con el código \"$codigo\". Usa un código diferente.";
            require __DIR__ . '/../views/productos/crear.php';
            return;
        }

        $ok = $this->repo->crear([
            'codigo'    => $codigo,
            'nombre'    => $nombre,
            'marca'     => $marca,
            'categoria' => $categoria,
            'precio'    => $precio,
            'stock'     => $stock,
        ]);

        if (!$ok) {
            $error = 'Ocurrió un error al guardar el producto. Intenta de nuevo.';
            require __DIR__ . '/../views/productos/crear.php';
            return;
        }

        header('Location: index.php?accion=catalogo&exito=1');
        exit;
    }

    public function editar(): void {
        $codigo   = $_GET['codigo'] ?? '';
        $producto = $this->repo->buscarPorCodigo($codigo);
        if ($producto === null) {
            header('Location: index.php?accion=catalogo');
            exit;
        }
        require __DIR__ . '/../views/productos/editar.php';
    }

    public function actualizar(): void {
        $codigo = $_POST['codigo'] ?? '';
        $nombre = trim($_POST['nombre'] ?? '');
        $precio = $_POST['precio'] ?? '';
        $stock  = $_POST['stock']  ?? '';

        if ($codigo === '' || $nombre === '' || $precio === '' || $stock === '') {
            $error    = 'Todos los campos son obligatorios.';
            $producto = new Producto($codigo, $nombre, (float)$precio, (int)$stock);
            require __DIR__ . '/../views/productos/editar.php';
            return;
        }

        $producto = new Producto($codigo, $nombre, (float)$precio, (int)$stock);
        $this->repo->actualizar($producto);
        header('Location: index.php?accion=catalogo');
        exit;
    }
}
