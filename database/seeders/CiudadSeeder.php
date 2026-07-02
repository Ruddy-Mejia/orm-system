<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ciudad;

class CiudadSeeder extends Seeder
{
    public function run(): void
    {
        $ciudades = [
            'Santiago', 'Valparaíso', 'Concepción', 'La Serena', 'Antofagasta',
            'Temuco', 'Rancagua', 'Talca', 'Arica', 'Iquique', 'Puerto Montt',
            'Calama', 'Copiapó', 'Quillota', 'Los Ángeles'
        ];
        
        foreach ($ciudades as $ciudad) {
            Ciudad::create(['nombre' => $ciudad]);
        }
    }
}