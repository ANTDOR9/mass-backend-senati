<?php
declare(strict_types=1);

class Producto {
    private string $codigo;
    private string $nombre;
    private float  $precio;
    private int    $stock;
    private bool   $disponible;

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

    // GETTERS
    public function getCodigo(): string {
        return $this->codigo;
    }
    public function getNombre(): string {
        return $this->nombre;
    }
    public function getPrecio(): float {
        return $this->precio;
    }
    public function getStock(): int {
        return $this->stock;
    }
    public function getDisponible(): bool {
        return $this->disponible;
    }

    // SETTERS
    public function setPrecio(float $precio): void {
        if ($precio < 0) {
            throw new Exception("El precio no puede ser negativo");
        }
        $this->precio = $precio;
    }
    public function setStock(int $stock): void {
        if ($stock < 0) {
            throw new Exception("El stock ha de ser mayor a 0");
        }
        $this->stock = $stock;
    }
}
?>