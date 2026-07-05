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
        $ordenes = Orm::with(['cdcRel', 'adnRel', 'sitioRel', 'responsableRel', 'compradorRel'])->orderBy($this->sortField, $this->sortDirection)
            ->paginate(15);
        return view('livewire.acquisitions.orm.orm-list', [
            'ordenes' => $ordenes,
        ]);
    }
}