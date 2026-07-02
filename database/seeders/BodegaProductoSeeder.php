<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BodegaProducto;
use App\Models\Bodega;
use App\Models\Producto;

class BodegaProductoSeeder extends Seeder
{
    public function run(): void
    {
        $bodegas = Bodega::all();
        $productos = Producto::all();
        
        foreach ($bodegas as $bodega) {
            // Cada bodega tiene entre 10 y 15 productos
            $productosRandom = $productos->random(rand(10, 15));
            
            foreach ($productosRandom as $producto) {
                BodegaProducto::create([
                    'bodega' => $bodega->id,
                    'producto' => $producto->id,
                    'cantidad' => rand(0, 1000),
                ]);
            }
        }
    }
}