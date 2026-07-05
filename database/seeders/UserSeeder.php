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
                'name' => 'Sin asignar',
                'email' => 'comprador@sistema.com',
                'password' => 'comprador123',
                'status' => true,
                'rol' => 'Comprador',
            ],
            [
                'name' => 'Administrador',
                'email' => 'rmejiam.dev@gmail.com',
                'password' => '12345678',
                'status' => true,
                'rol' => 'Administrador',
            ],
            [
                'name' => 'Luis Meza',
                'email' => 'comprador@example.com',
                'password' => '12345678',
                'status' => true,
                'rol' => 'Comprador',
            ],
            [
                'name' => 'Carla López',
                'email' => 'jefebodega@example.com',
                'password' => '12345678',
                'status' => true,
                'rol' => 'Jefe de Bodega',
            ],
            [
                'name' => 'Daniel Torres',
                'email' => 'user@example.com',
                'password' => '12345678',
                'status' => true,
                'rol' => 'Perfil básico',
            ],
        ];

        foreach ($usuarios as $usuario) {
            User::create([
                'name' => $usuario['name'],
                'email' => $usuario['email'],
                'password' => Hash::make($usuario['password']),
                'status' => $usuario['status'],
                'rol' => $roles[$usuario['rol']],
                'foto_perfil' => null,
                'firma' => null,
            ]);
        }
        User::factory(10)->create();
    }
}