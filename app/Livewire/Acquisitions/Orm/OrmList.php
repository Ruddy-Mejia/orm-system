<?php

namespace App\Livewire\Acquisitions\Orm;

use App\Models\Orm;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class OrmList extends Component
{
    use WithPagination;

    // Filtros
    public $search = '';
    public $estatus = '';
    public $prioridad = '';
    public $fecha_desde = '';
    public $fecha_hasta = '';

    // Ordenamiento
    public $sortField = 'id';
    public $sortDirection = 'desc';

    protected $queryString = ['search', 'estatus', 'sortField', 'sortDirection'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function toggleAtencion($id)
    {
        $orden = Orm::find($id);
        $orden->en_atencion = !$orden->en_atencion;
        $orden->save();

        $this->dispatch('toast', type: 'success', message: 'Estado actualizado correctamente');
    }

    public function render()
    {
        // $ordenes = Orm::with(['cdcRel', 'adnRel', 'sitioRel', 'responsableRel', 'compradorRel'])->orderBy($this->sortField, $this->sortDirection)
        //     ->paginate(15);
        $ordenes = Orm::with(['cdcRel', 'adnRel', 'sitioRel', 'responsableRel', 'compradorRel'])
            ->when($this->search, function ($query) {
                $search = '%' . $this->search . '%';
                $query->where(function ($q) use ($search) {
                    $q->where('orm', 'like', $search)
                        ->orWhere('descripcion', 'like', $search)
                        ->orWhere('patente', 'like', $search)
                        ->orWhere('tipo', 'like', $search)
                        ->orWhere('prioridad', 'like', $search)
                        ->orWhereHas('cdcRel', function ($subQuery) use ($search) {
                            $subQuery->where('cdc', 'like', $search);
                        })
                        ->orWhereHas('adnRel', function ($subQuery) use ($search) {
                            $subQuery->where('adn', 'like', $search)
                                ->orWhere('descripcion', 'like', $search);
                        })
                        ->orWhereHas('sitioRel', function ($subQuery) use ($search) {
                            $subQuery->where('descripcion', 'like', $search);
                        })
                        ->orWhereHas('responsableRel', function ($subQuery) use ($search) {
                            $subQuery->whereHas('personRel', function ($personQuery) use ($search) {
                                $personQuery->where('nombres', 'like', $search)
                                    ->orWhere('apellido_paterno', 'like', $search)
                                    ->orWhere('apellido_materno', 'like', $search)
                                    ->orWhere('rut', 'like', $search)
                                    ->orWhere('email', 'like', $search)
                                    ->orWhereRaw("CONCAT(nombres, ' ', apellido_paterno) LIKE ?", [$search])
                                    ->orWhereRaw("CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) LIKE ?", [$search]);
                            });
                        });
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(15);
        return view('livewire.acquisitions.orm.orm-list', [
            'ordenes' => $ordenes,
        ]);
    }
}
