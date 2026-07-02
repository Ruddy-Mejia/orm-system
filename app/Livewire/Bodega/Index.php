<?php
// app/Livewire/Bodega/Index.php

namespace App\Livewire\Bodega;

use App\Models\Bodega;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $queryString = ['search'];

    public function render()
    {
        $bodegas = Bodega::withCount(['bodegaProductosRel as total_productos' => function($query) {
                $query->where('cantidad', '>', 0);
            }])
            ->when($this->search, function($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%')
                      ->orWhere('sitio', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);

        return view('livewire.bodega.index', compact('bodegas'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}