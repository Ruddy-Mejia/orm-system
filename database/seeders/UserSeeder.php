<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = Role::pluck('id', 'nombre')->toArray();

        $usuarios = [
            [
                'email' => 'rmejiam.dev@gmail.com',
                'password' => '12345678',
                'status' => true,
                'rol' => 'Administrador',
                'person_id' => 1,
            ],
            [
                'email' => 'comprador@sistema.com',
                'password' => 'comprador123',
                'status' => true,
                'rol' => 'Comprador',
                'person_id' => 2,
            ],
            [
                'email' => 'comprador@example.com',
                'password' => '12345678',
                'status' => true,
                'rol' => 'Comprador',
                'person_id' => 3,
            ],
            [
                'email' => 'jefebodega@example.com',
                'password' => '12345678',
                'status' => true,
                'rol' => 'Jefe de Bodega',
                'person_id' => 4,
            ],
            [
                'email' => 'user@example.com',
                'password' => '12345678',
                'status' => true,
                'rol' => 'Perfil básico',
                'person_id' => 5,
            ],
        ];

        foreach ($usuarios as $usuario) {
            User::create([
                'email' => $usuario['email'],
                'password' => Hash::make($usuario['password']),
                'status' => $usuario['status'],
                'rol' => $roles[$usuario['rol']],
                'foto_perfil' => null,
                'firma' => null,
                'person_id' => $usuario['person_id'],
            ]);
        }
        // User::factory(10)->create();
    }
}