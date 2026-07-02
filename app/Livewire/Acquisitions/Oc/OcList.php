<?php

namespace App\Livewire\Acquisitions\Oc;

use App\Models\Oc;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.app')]

class OcList extends Component
{
    use WithPagination;

    public $search = '';
    public $prioridad = '';
    public $fecha_desde = '';
    public $fecha_hasta = '';

    // Ordenamiento
    public $sortField = 'oc';
    public $sortDirection = 'desc';

    protected $queryString = ['search', 'sortField', 'sortDirection'];

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

    public function render()
    {
        $ocs = Oc::with(['detormRel'])->orderBy($this->sortField, $this->sortDirection)
            ->paginate(15);
        return view('livewire.acquisitions.oc.oc-list', [
            'ocs' => $ocs,
        ]);
    }
}
