<?php

namespace App\Livewire\RRHH\Users;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class UserList extends Component
{
    use WithPagination;

    // Filtros
    public $search = '';
    public $statusFilter = '';
    public $rolFilter = '';
    public $perPage = 10;

    // Modal
    public $showModal = false;
    public $modalTitle = '';
    public $userId = null;

    // Formulario
    public $name = '';
    public $email = '';
    public $password = '';
    public $status = true;
    public $rol_id = '';
    public $foto_perfil = null;
    public $firma = null;

    // Listas
    public $roles = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:tbl_users,email',
        'password' => 'required|min:6',
        'status' => 'boolean',
        'rol_id' => 'required|exists:tbl_roles,id',
        'foto_perfil' => 'nullable|image|max:1024',
        'firma' => 'nullable|image|max:1024',
    ];

    protected $messages = [
        'name.required' => 'El nombre es obligatorio',
        'email.required' => 'El email es obligatorio',
        'email.unique' => 'Este email ya está registrado',
        'password.required' => 'La contraseña es obligatoria',
        'password.min' => 'La contraseña debe tener al menos 6 caracteres',
        'rol_id.required' => 'Debe seleccionar un rol',
    ];

    public function mount()
    {
        $this->loadRoles();
    }

    public function loadRoles()
    {
        $this->roles = Role::all();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingRolFilter()
    {
        $this->resetPage();
    }

    public function getUsersProperty()
    {
        $query = User::with('rolRel');

        // Búsqueda por nombre o email
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        // Filtro por status
        if ($this->statusFilter !== '') {
            $query->where('status', $this->statusFilter);
        }

        // Filtro por rol
        if ($this->rolFilter) {
            $query->where('rol', $this->rolFilter);
        }

        return $query->orderBy('name')->paginate($this->perPage);
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->modalTitle = 'Crear Usuario';
        $this->showModal = true;
    }

    public function openEditModal($id)
    {
        $user = User::find($id);
        if ($user) {
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->status = $user->status;
            $this->rol_id = $user->rol;
            $this->modalTitle = 'Editar Usuario';
            $this->showModal = true;

            // Remover regla de password único para edición
            $this->rules['email'] = 'required|email|unique:tbl_users,email,' . $id;
            $this->rules['password'] = 'nullable|min:6';
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->userId = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->status = true;
        $this->rol_id = '';
        $this->foto_perfil = null;
        $this->firma = null;

        // Restaurar reglas
        // $this->rules['email'] = 'required|email|unique:tbl_users,email';
        // $this->rules['password'] = 'required|min:6';
    }

    public function save()
    {
        if ($this->userId) {
            // Para edición
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:tbl_users,email,' . $this->userId,
                'password' => 'nullable|min:6',
                'status' => 'boolean',
                'rol_id' => 'required|exists:tbl_roles,id',
            ];
        } else {
            // Para creación
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:tbl_users,email',
                'password' => 'required|min:6',
                'status' => 'boolean',
                'rol_id' => 'required|exists:tbl_roles,id',
            ];
        }
        $this->validate($rules);

        try {
            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'status' => $this->status,
                'rol' => $this->rol_id,
            ];

            // Procesar foto_perfil
            if ($this->foto_perfil) {
                $data['foto_perfil'] = $this->foto_perfil->store('users/fotos', 'public');
            }

            // Procesar firma
            if ($this->firma) {
                $data['firma'] = $this->firma->store('users/firmas', 'public');
            }

            if ($this->userId) {
                // Actualizar
                if ($this->password) {
                    $data['password'] = Hash::make($this->password);
                }
                User::where('id', $this->userId)->update($data);
                $this->dispatch('toastr', ['type' => 'success', 'message' => 'Usuario actualizado correctamente']);
            } else {
                // Crear
                $data['password'] = Hash::make($this->password);
                User::create($data);
                $this->dispatch('toastr', ['type' => 'success', 'message' => 'Usuario creado correctamente']);
            }

            $this->closeModal();
        } catch (\Exception $e) {
            $this->dispatch('toastr', ['type' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function toggleStatus($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = !$user->status;
            $user->save();
            $statusText = $user->status ? 'activado' : 'desactivado';
            $this->dispatch('toastr', ['type' => 'success', 'message' => "Usuario {$statusText} correctamente"]);
        }
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $name = $user->name;
            $user->delete();
            $this->dispatch('toastr', ['type' => 'success', 'message' => "Usuario {$name} eliminado correctamente"]);
        }
    }

    public function render()
    {
        return view('livewire.rrhh.users.user-list', [
            'users' => $this->users,
        ]);
    }
}
