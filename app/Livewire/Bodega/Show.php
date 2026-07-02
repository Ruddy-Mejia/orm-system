<?php
// app/Livewire/Bodega/Show.php

namespace App\Livewire\Bodega;

use App\Models\Bodega;
use App\Models\MovimientoBodega;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class Show extends Component
{
    use WithPagination;

    public Bodega $bodega;
    public $search = '';
    public $perPage = 10;
    public $filtroTipo = '';

    protected $queryString = ['search', 'filtroTipo'];

    public function mount($bodega)
    {
        $this->bodega = $bodega;
    }

    public function render()
    {
        // Productos en la bodega
        $productos = $this->bodega->productosRel()
            ->withPivot('cantidad')
            ->wherePivot('cantidad', '>', 0)
            ->when($this->search, function($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage, ['*'], 'productosPage');

        // Movimientos
        $movimientos = MovimientoBodega::where('bodega_id', $this->bodega->id)
            ->with(['productoRel', 'usuarioRel'])
            ->when($this->filtroTipo, function($query) {
                $query->where('tipo', $this->filtroTipo);
            })
            ->when($this->search, function($query) {
                $query->whereHas('productoRel', function($q) {
                    $q->where('nombre', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage, ['*'], 'movimientosPage');

        $tiposMovimientos = ['ingreso', 'egreso', 'traspaso_salida', 'traspaso_entrada'];

        // Resumen de stock
        $totalProductos = $this->bodega->bodegaProductosRel()
            ->where('cantidad', '>', 0)
            ->count();

        $totalUnidades = $this->bodega->bodegaProductosRel()
            ->sum('cantidad');

        return view('livewire.bodega.show', compact(
            'productos',
            'movimientos',
            'tiposMovimientos',
            'totalProductos',
            'totalUnidades'
        ));
    }

    public function updatingSearch()
    {
        $this->resetPage('productosPage');
        $this->resetPage('movimientosPage');
    }

    public function updatingFiltroTipo()
    {
        $this->resetPage('movimientosPage');
    }
}