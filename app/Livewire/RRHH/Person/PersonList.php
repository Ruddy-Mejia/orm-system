<?php

namespace App\Livewire\RRHH\Person;

use App\Models\Person;
use App\Models\Sitio;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class PersonList extends Component
{
    use WithPagination;

    public $search = '';
    public $companyFilter = '';
    public $siteFilter = '';
    public $perPage = 10;

    public function deletePerson($id)
    {
        $person = Person::findOrFail($id);
        $person->delete();
        session()->flash('message', 'Persona eliminada exitosamente.');
    }

    public function render()
    {
        static $sitios = null;
        if ($sitios === null) {
            $sitios = Sitio::all(['id', 'descripcion']);
        }
        $persons = Person::query()
            ->when($this->search, function ($query) {
                $search = '%' . $this->search . '%';
                $query->where(function ($q) use ($search) {
                    $q->where('rut', 'like', $search)
                        ->orWhere('nombres', 'like', $search)
                        ->orWhere('apellido_paterno', 'like', $search)
                        ->orWhere('apellido_materno', 'like', $search)
                        ->orWhere('email', 'like', $search)
                        // Buscar nombre completo (nombres + apellido_paterno)
                        ->orWhereRaw("CONCAT(nombres, ' ', apellido_paterno) LIKE ?", [$search])
                        // Buscar nombre completo (nombres + apellido_paterno + apellido_materno)
                        ->orWhereRaw("CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) LIKE ?", [$search])
                        // Buscar apellido + nombre
                        ->orWhereRaw("CONCAT(apellido_paterno, ' ', nombres) LIKE ?", [$search]);
                });
            })
            ->when($this->companyFilter, function ($query) {
                $query->where('empresa', $this->companyFilter);
            })
            ->when($this->siteFilter, function ($query) {
                $query->where('sitio_id', $this->siteFilter);
            })
            ->orderBy('created_at', 'desc')
            ->with('sitioRel')
            ->paginate($this->perPage);

        return view('livewire.rrhh.person.person-list', [
            'persons' => $persons,
            'sitios' => $sitios,
        ]);
    }
}
