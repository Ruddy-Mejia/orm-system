<?php

namespace App\Livewire\RRHH\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\Person;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class UserCreate extends Component
{
    use WithFileUploads;

    public $person_id = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $rol_id = '';
    public $status = true;
    public $foto_perfil = null;
    public $firma = null;

    public $searchPerson = '';
    public $persons = [];
    public $selectedPerson = null;

    protected $rules = [
        'person_id' => 'required|exists:tbl_person,id',
        'email' => 'required|email|unique:tbl_users,email',
        'password' => 'required|min:6|confirmed',
        'rol_id' => 'required|exists:tbl_roles,id',
        'status' => 'boolean',
        'foto_perfil' => 'nullable|image|max:2048',
        'firma' => 'nullable|image|max:2048',
    ];

    protected $messages = [
        'person_id.required' => 'Debe seleccionar una persona',
        'person_id.exists' => 'La persona seleccionada no existe',
        'email.required' => 'El email es obligatorio',
        'email.unique' => 'Este email ya está registrado',
        'password.required' => 'La contraseña es obligatoria',
        'password.min' => 'La contraseña debe tener al menos 6 caracteres',
        'password.confirmed' => 'Las contraseñas no coinciden',
        'rol_id.required' => 'Debe seleccionar un rol',
    ];

    public function updatedSearchPerson()
    {
        if (strlen($this->searchPerson) >= 2) {
            $this->persons = Person::where(function ($query) {
                $query->where('rut', 'like', '%' . $this->searchPerson . '%')
                    ->orWhere('nombres', 'like', '%' . $this->searchPerson . '%')
                    ->orWhere('apellido_paterno', 'like', '%' . $this->searchPerson . '%')
                    ->orWhere('apellido_materno', 'like', '%' . $this->searchPerson . '%');
            })
                ->limit(10)
                ->get();
        } else {
            $this->persons = [];
        }
    }

    public function selectPerson($id)
    {
        // Asegurar que el ID es un entero
        $id = (int) $id;

        $person = Person::find($id);
        if ($person) {            
            $this->selectedPerson = $person;
            $this->person_id = $person->id;
            $this->searchPerson = $person->rut . ' - ' . $person->nombres . ' ' . $person->apellido_paterno;
            $this->persons = [];
        }
    }

    public function clearPerson()
    {
        $this->selectedPerson = null;
        $this->person_id = '';
        $this->searchPerson = '';
    }

    public function save()
    {
        if (empty($this->person_id)) {
            session()->flash('error', 'Debe seleccionar una persona');
        }

        try {
            $data = [
                'person_id' => $this->person_id,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'status' => $this->status,
                'rol' => $this->rol_id,
            ];

            if ($this->foto_perfil) {
                $data['foto_perfil'] = $this->foto_perfil->store('users/fotos', 'public');
            }

            if ($this->firma) {
                $data['firma'] = $this->firma->store('users/firmas', 'public');
            }

            User::create($data);

            session()->flash('success', 'Usuario creado exitosamente');
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al crear el usuario: ' . $e->getMessage());
        }
    }

    public function cancel()
    {
        return redirect()->route('users.index');
    }

    public function render()
    {
        $roles = Role::all();
        return view('livewire.rrhh.users.user-create', [
            'roles' => $roles,
        ]);
    }
}
