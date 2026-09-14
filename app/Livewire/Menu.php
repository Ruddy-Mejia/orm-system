<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Menu extends Component
{
    public $menuItems = [];
    public $userName = '';
    public $userEmail = '';
    public $userRole = '';

    public function mount()
    {
        $this->loadMenu();
        $this->loadUserInfo();
    }

    public function loadUserInfo()
    {
        $user = Auth::user();
        if ($user) {
            $this->userEmail = $user->email;
            $this->userRole = $user->rolRel->nombre ?? 'N/A';
            
            if ($user->personRel) {
                $this->userName = $user->personRel->nombres . ' ' . 
                                 $user->personRel->apellido_paterno . 
                                 ' (' . $this->userRole . ')';
            } else {
                $this->userName = $user->name . ' (' . $this->userRole . ')';
            }
        }
    }

    public function loadMenu()
    {
        $allMenuItems = [
            [
                'label' => 'Dashboard',
                'route' => 'dashboard',
                'permissions' => ['dashboard'],
                'icon' => 'home',
            ],
            [
                'label' => 'Bodegas',
                'route' => 'bodegas.index',
                'permissions' => ['bodegas.view', 'bodegas.index', 'bodegas.ingreso', 'bodegas.traspaso', 'bodegas.show'],
                'icon' => 'warehouse',
            ],
            [
                'label' => 'Adquisiciones',
                'route' => null, // No tiene ruta directa, es un dropdown
                'permissions' => ['orm.index', 'orm.create', 'orm.view', 'orm.print', 'oc.index', 'oc.create', 'oc.show', 'oc.edit'],
                'icon' => 'shopping-cart',
                'children' => [
                    [
                        'label' => 'ORMs',
                        'route' => 'orm.index',
                        'permissions' => ['orm.index', 'orm.create', 'orm.view', 'orm.print'],
                    ],
                    [
                        'label' => 'OCs',
                        'route' => 'oc.index',
                        'permissions' => ['oc.index', 'oc.create', 'oc.show', 'oc.edit'],
                    ],
                ],
            ],
            [
                'label' => 'Productos',
                'route' => null, // No tiene ruta directa, es un dropdown
                'permissions' => ['products.index', 'products.create', 'categories.index'],
                'icon' => 'box',
                'children' => [
                    [
                        'label' => 'Productos',
                        'route' => 'products.index',
                        'permissions' => ['products.index', 'products.create'],
                    ],
                    [
                        'label' => 'Categorías',
                        'route' => 'categories.index',
                        'permissions' => ['categories.index'],
                    ],
                ],
            ],
            [
                'label' => 'RRHH',
                'route' => null,
                'permissions' => ['users.index', 'users.create', 'users.edit', 'personas.index', 'personas.create', 'personas.edit'],
                'icon' => 'users',
                'children' => [
                    [
                        'label' => 'Usuarios',
                        'route' => 'users.index',
                        'permissions' => ['users.index', 'users.create', 'users.edit'],
                    ],
                    [
                        'label' => 'Trabajadores',
                        'route' => 'personas.index',
                        'permissions' => ['personas.index', 'personas.create', 'personas.edit'],
                    ],
                ],
            ],
        ];

        // Filtrar según permisos
        $this->menuItems = $this->filterMenuItems($allMenuItems);
    }

    private function filterMenuItems($items)
    {
        $filtered = [];
        
        foreach ($items as $item) {
            // Verificar si el usuario tiene algún permiso de este item
            if ($this->userHasPermissions($item['permissions'] ?? [])) {
                // Si tiene hijos, filtrarlos también
                if (isset($item['children'])) {
                    $filteredChildren = $this->filterMenuItems($item['children']);
                    if (!empty($filteredChildren)) {
                        $item['children'] = $filteredChildren;
                        $filtered[] = $item;
                    }
                } else {
                    $filtered[] = $item;
                }
            }
        }
        
        return $filtered;
    }

    private function userHasPermissions($permissions)
    {
        if (!Auth::check()) {
            return false;
        }

        if (empty($permissions)) {
            return true;
        }

        foreach ($permissions as $permission) {
            if (Auth::user()->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }

    public function logout()
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.menu');
    }
}