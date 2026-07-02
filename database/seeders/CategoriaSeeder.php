<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Insumos Mineros', 'descripcion' => 'Materiales para minería'],
            ['nombre' => 'Herramientas Industriales', 'descripcion' => 'Herramientas para uso industrial'],
            ['nombre' => 'Equipos de Seguridad', 'descripcion' => 'EPP y equipos de protección'],
            ['nombre' => 'Materiales de Construcción', 'descripcion' => 'Materiales para construcción'],
            ['nombre' => 'Equipos Eléctricos', 'descripcion' => 'Componentes y equipos eléctricos'],
            ['nombre' => 'Lubricantes y Combustibles', 'descripcion' => 'Lubricantes y combustibles'],
            ['nombre' => 'Servicios Técnicos', 'descripcion' => 'Servicios especializados'],
            ['nombre' => 'Oficina y Administración', 'descripcion' => 'Insumos de oficina'],
        ];
        
        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}