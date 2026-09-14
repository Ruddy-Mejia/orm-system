<?php

namespace App\Livewire\RRHH\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use App\Helpers\HistorialHelper;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class UserEdit extends Component
{
    use WithFileUploads;

    public $userId;
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $rol_id = '';
    public $status = true;
    public $foto_perfil = null;
    public $firma = null;
    public $foto_perfil_actual = null;
    public $firma_actual = null;
    public $personInfo = null;

    protected function rules()
    {
        return [
            'email' => 'required|email|unique:tbl_users,email,' . $this->userId,
            'password' => 'nullable|min:6|confirmed',
            'rol_id' => 'required|exists:tbl_roles,id',
            'status' => 'boolean',
            'foto_perfil' => 'nullable|image|max:2048',
            'firma' => 'nullable|image|max:2048',
        ];
    }

    protected $messages = [
        'email.required' => 'El email es obligatorio',
        'email.unique' => 'Este email ya está registrado',
        'password.min' => 'La contraseña debe tener al menos 6 caracteres',
        'password.confirmed' => 'Las contraseñas no coinciden',
        'rol_id.required' => 'Debe seleccionar un rol',
    ];

    public function mount($id)
    {
        $this->userId = $id;
        $this->loadUser();
    }

    public function loadUser()
    {
        $user = User::with('personRel')->findOrFail($this->userId);
        $this->email = $user->email;
        $this->status = $user->status;
        $this->rol_id = $user->rol;
        $this->foto_perfil_actual = $user->foto_perfil;
        $this->firma_actual = $user->firma;
        $this->personInfo = $user->personRel;
    }

    // public function update()
    // {
    //     $this->validate();

    //     try {
    //         $data = [
    //             'email' => $this->email,
    //             'status' => $this->status,
    //             'rol' => $this->rol_id,
    //         ];

    //         if ($this->password) {
    //             $data['password'] = Hash::make($this->password);
    //         }

    //         if ($this->foto_perfil) {
    //             $data['foto_perfil'] = $this->foto_perfil->store('users/fotos', 'public');
    //         }

    //         if ($this->firma) {
    //             $data['firma'] = $this->firma->store('users/firmas', 'public');
    //         }

    //         User::where('id', $this->userId)->update($data);

    //         session()->flash('success', 'Usuario actualizado exitosamente');
    //         return redirect()->route('users.index');

    //     } catch (\Exception $e) {
    //         session()->flash('error', 'Error al actualizar el usuario: ' . $e->getMessage());
    //     }
    // }
    public function update()
    {
        $this->validate();

        try {
            // Obtener el usuario antes de actualizar
            $user = User::findOrFail($this->userId);
            $oldData = $user->toArray();

            // Preparar los nuevos datos
            $data = [
                'email' => $this->email,
                'status' => $this->status,
                'rol' => $this->rol_id,
            ];

            if ($this->password) {
                $data['password'] = Hash::make($this->password);
            }

            if ($this->foto_perfil) {
                $data['foto_perfil'] = $this->foto_perfil->store('users/fotos', 'public');
            }

            if ($this->firma) {
                $data['firma'] = $this->firma->store('users/firmas', 'public');
            }

            // Actualizar el usuario
            User::where('id', $this->userId)->update($data);

            // Obtener el usuario actualizado
            $userUpdated = User::findOrFail($this->userId);
            $newData = $userUpdated->toArray();

            // Detectar qué campos cambiaron
            $camposCambiados = [];
            foreach ($oldData as $key => $value) {
                if (isset($newData[$key]) && $value != $newData[$key]) {
                    $camposCambiados[] = $key;
                }
            }

            // Registrar en el historial - ACTUALIZACIÓN
            HistorialHelper::updated(
                'tbl_users',
                $this->userId,
                $oldData,
                $newData,
                'Se actualizó el usuario: ' . $this->email
            );

            session()->flash('success', 'Usuario actualizado exitosamente');
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            // Registrar el error en el historial
            HistorialHelper::error(
                'Error al actualizar usuario: ' . $e->getMessage(),
                'tbl_users',
                $this->userId,
                [
                    'error' => $e->getMessage(),
                    'user_id' => $this->userId,
                ]
            );

            session()->flash('error', 'Error al actualizar el usuario: ' . $e->getMessage());
        }
    }

    public function cancel()
    {
        return redirect()->route('users.index');
    }

    public function render()
    {
        $roles = Role::all();
        return view('livewire.rrhh.users.user-edit', [
            'roles' => $roles,
        ]);
    }
}
