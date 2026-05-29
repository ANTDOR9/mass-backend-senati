<?php
declare(strict_types=1);

class Producto {
    public string $codigo;
    public string $nombre;
    public float  $precio;
    public int    $stock;
    public bool   $disponible;

    public function __construct(
        string $codigo,
        string $nombre,
        float  $precio,
        int    $stock,
        bool   $disponible = true
    ) {
        $this->codigo     = $codigo;
        $this->nombre     = $nombre;
        $this->precio     = $precio;
        $this->stock      = $stock;
        $this->disponible = $disponible;
    }
}
?>