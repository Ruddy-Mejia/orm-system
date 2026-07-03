<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['Administrador', 'Comprador', 'Solicitante', 'Jefe de Bodega', 'Perfil básico'];
        $guard_names = ['admin', 'comprador', 'solicitante', 'jefe_bodega','perfil_basico'];
        
        foreach ($roles as $i => $rol) {
            Role::firstOrCreate(['nombre' => $rol, 'guard_name' => $guard_names[$i]]);
        }
    }
}