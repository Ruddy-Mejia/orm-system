<?php
// config/roles.php

return [
    'roles' => [
        // Administrador - Acceso total al sistema
        'admin' => [
            'name' => 'Administrador',
            'permissions' => [
                'dashboard',
                'bodegas.*',
                'bodegas.ingreso',
                'bodegas.traspaso',
                'bodegas.view',
                'bodegas.index',
                'orm.*',
                'orm.create',
                'orm.view',
                'orm.edit',
                'oc.*',
                'oc.create',
                'oc.view',
                'oc.edit',
                'usuarios.*',
                'usuarios.view',
                'usuarios.create',
                'usuarios.edit',
                'usuarios.delete',
                'reportes.*',
                'configuracion.*',
            ],
        ],

        // Comprador - Crea y gestiona órdenes de compra
        'comprador' => [
            'name' => 'Comprador',
            'permissions' => [
                'dashboard',
                'orm.view',
                'orm.create',
                'oc.view',
                'oc.create',
                'oc.edit',
                'bodegas.view',
                'reportes.view',
            ],
        ],

        // Solicitante - Crea y visualiza ORM
        'solicitante' => [
            'name' => 'Solicitante',
            'permissions' => [
                'dashboard',
                'orm.create',
                'orm.view',
                'bodegas.view',
            ],
        ],

        // Jefe de Bodega - Gestiona inventario y movimientos
        'jefe_bodega' => [
            'name' => 'Jefe de Bodega',
            'permissions' => [
                'dashboard',
                'bodegas.*',
                'bodegas.ingreso',
                'bodegas.traspaso',
                'bodegas.view',
                'bodegas.index',
                'reportes.inventario',
            ],
        ],

        // Perfil Básico - Solo lectura básica
        'perfil_basico' => [
            'name' => 'Perfil Básico',
            'permissions' => [
                'dashboard',
                'bodegas.view',
                'orm.view',
            ],
        ],
    ],
];