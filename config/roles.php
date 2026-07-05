<?php

return [
    'roles' => [
        'comprador' => [
            'name' => 'Comprador',
            'permissions' => [
                'dashboard',
                'orm.view',
                'orm.create',
                'oc.show',
                'oc.create',
                'oc.edit',
                'bodegas.view',
                'reportes.view',
            ],
        ],

        'solicitante' => [
            'name' => 'Solicitante',
            'permissions' => [
                'dashboard',
                'orm.create',
                'orm.view',
                'bodegas.view',
            ],
        ],

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
                'products.*',
                'categories.*',
            ],
        ],

        'perfil_basico' => [
            'name' => 'Perfil Básico',
            'permissions' => [
                'dashboard',
                'oc.index',
                'bodegas.view',
                'orm.index'
            ],
        ],
    ],
];
