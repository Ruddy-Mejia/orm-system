<?php

namespace App\Livewire\RRHH\Users;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Role;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class UserList extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $rolFilter = '';
    public $perPage = 10;
    
    // Para el modal de ver persona
    public $showPersonModal = false;
    public $selectedPerson = null;

    public function getUsersProperty()
    {
        $query = User::with('rolRel', 'personRel');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('email', 'like', '%' . $this->search . '%')
                    ->orWhereHas('personRel', function ($subQuery) {
                        $subQuery->where('nombres', 'like', '%' . $this->search . '%')
                            ->orWhere('apellido_paterno', 'like', '%' . $this->search . '%')
                            ->orWhere('apellido_materno', 'like', '%' . $this->search . '%')
                            ->orWhere('rut', 'like', '%' . $this->search . '%');
                    });
            });
        }

        if ($this->statusFilter !== '') {
            $query->where('status', $this->statusFilter);
        }

        if ($this->rolFilter) {
            $query->where('rol', $this->rolFilter);
        }

        return $query->orderBy('id', 'desc')->paginate($this->perPage);
    }

    public function toggleStatus($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = !$user->status;
            $user->save();
            session()->flash('message', 'Usuario ' . ($user->status ? 'activado' : 'desactivado') . ' correctamente');
        }
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $email = $user->email;
            $user->delete();
            session()->flash('message', "Usuario {$email} eliminado correctamente");
        }
    }

    // Método para ver los datos de la persona
    public function viewPerson($userId)
    {
        $user = User::with('personRel')->find($userId);
        if ($user && $user->personRel) {
            $this->selectedPerson = $user->personRel;
            $this->showPersonModal = true;
        } else {
            session()->flash('message', 'Esta persona no tiene datos asociados');
        }
    }

    public function closePersonModal()
    {
        $this->showPersonModal = false;
        $this->selectedPerson = null;
    }

    public function render()
    {
        $roles = Role::all();
        
        return view('livewire.rrhh.users.user-list', [
            'users' => $this->users,
            'roles' => $roles,
        ]);
    }
}