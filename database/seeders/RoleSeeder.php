<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['Administrador', 'Comprador', 'Solicitante', 'Jefe de Bodega', 'Perfil básico'];
        
        foreach ($roles as $rol) {
            Role::firstOrCreate(['nombre' => $rol]);
        }
    }
}