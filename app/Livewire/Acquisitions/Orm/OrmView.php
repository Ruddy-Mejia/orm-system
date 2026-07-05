<?php
// app/Livewire/Acquisitions/Orm/OrmView.php

namespace App\Livewire\Acquisitions\Orm;

use Livewire\Component;
use App\Models\Orm;
use App\Models\User;
use App\Models\DetOrm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class OrmView extends Component
{
    public $productosSeleccionados = [];
    public $seleccionarTodos = false;
    public $itemsSinOC = 0;
    public $productosSeleccionadosCount = 0;

    // Calcular items sin OC
    private function calcularItemsSinOC()
    {
        $this->itemsSinOC = $this->orm->detormRel->filter(fn($i) => !$i->ocRel)->count();
    }

    // Cuando cambia seleccionarTodos
    public function updatedSeleccionarTodos($value)
    {
        if ($value) {
            $this->productosSeleccionados = $this->orm->detormRel
                ->filter(fn($i) => !$i->ocRel)
                ->pluck('id')
                ->toArray();
        } else {
            $this->productosSeleccionados = [];
        }
        $this->productosSeleccionadosCount = count($this->productosSeleccionados);
    }

    // Cuando cambia selección individual
    public function updatedProductosSeleccionados()
    {
        $this->productosSeleccionadosCount = count($this->productosSeleccionados);
    }

    // Generar OC
    public function generarOC()
    {

        if (empty($this->productosSeleccionados)) {            
            $this->dispatch('toast', type: 'error', message: "Seleccione al menos un producto");
            return;
        }

        // Construir URL con parámetros
        $params = [
            'detalles' => implode(',', $this->productosSeleccionados)
        ];

        return redirect()->route('oc.create', $params);
    }



    public $orm;
    public $ormId;

    public $buyers;
    public $buyerId;
    public $items = [];
    public $archivoUrl = null;
    public $modalAbierto = false;

    public function verArchivo($id)
    {
        $orm = Orm::where('id', $id)->first();
        $this->archivoUrl = Storage::url($orm->archivo);
        $this->modalAbierto = true;
    }

    public function cerrarModal()
    {
        $this->modalAbierto = false;
        $this->archivoUrl = null;
    }


    public function mount($id)
    {
        $this->ormId = $id;
        $this->cargarDatosORM();
        // $this->cargarDetallesORM();
        $this->getBuyers();
        $this->calcularItemsSinOC();
    }

    public function getBuyers()
    {
        // $this->buyers = User::where("rol", 2) CUANDO SE TENGAN BIEN DEFINIDOS
        $this->buyers = User::where("rol", 2)
            ->where("status", 1)
            ->orderBy('name', 'asc')
            ->get();
    }

    public function cargarDatosORM()
    {
        $this->orm = Orm::with(['cdcRel', 'adnRel', 'sitioRel', 'responsableRel', 'compradorRel', 'detormRel'])->where("tbl_orm.orm", $this->ormId)->first();
        $this->buyerId = $this->orm->comprador ?? 2;
    }
    public function volver()
    {
        return redirect()->to(url()->previous());
    }

    public function switchPriority($id)
    {
        $orm = Orm::where('id', $id)->first();
        $valores = ['sin prioridad', 'normal', 'emergencia'];
        $indiceActual = array_search($this->orm->prioridad, $valores);
        $nuevoIndice = ($indiceActual + 1) % count($valores);
        $orm->prioridad = $valores[$nuevoIndice];
        $orm->save();
        $this->cargarDatosORM();
        $this->dispatch('toast', type: 'success', message: "Prioridad cambió a {$orm->prioridad} correctamente");
    }
    public function askReview($id)
    {
        $orm = Orm::where('id', $id)->first();
        $orm->status = !$orm->status;
        $orm->save();        
        $this->cargarDatosORM();
        $this->dispatch('toast', type: 'info', message: 'Se solicitó la revisión');
    }

    public function toggleBool($id, $field)
    {
        try {
            $detorm = DetOrm::find($id);
            $valorActual = (bool) $detorm->{$field};
            $nuevoValor = !$valorActual;

            $detorm->{$field} = $nuevoValor;
            $detorm->save();
            $this->dispatch('toast', type: 'success', message: 'Se actualizó correctamente');
        } catch (\Throwable $th) {
            $this->dispatch('toast', type: 'error', message: 'Error al actualizar: ' . $th->getMessage());
        }
    }

    public function updateBuyer()
    {
        if (!$this->buyerId && $this->buyerId != 0) {
            $this->dispatch('toast', type: 'warning', message: 'Debe seleccionar un comprador');
            return;
        }

        try {
            $orm = Orm::where('id', $this->orm->id)->first();
            $orm->comprador = $this->buyerId;
            $orm->save();
            $this->cargarDatosORM();

            $newBuyer = User::find($this->buyerId);
            $this->dispatch('toast', type: 'success', message: "Comprador actualizado a: {$newBuyer->name}");
        } catch (\Exception $e) {
            $this->dispatch('toast', type: 'error', message: "Error al actualizar el comprador");
        }
    }

    public function print()
    {
        $ormId = $this->ormId;
        return redirect()->route('acquisitions.orm.print', $ormId);
    }

    public function render()
    {
        return view('livewire.acquisitions.orm.orm-view');
    }
}
