<?php
// app/Livewire/Bodega/Ingreso.php

namespace App\Livewire\Bodega;

use App\Models\Bodega;
use App\Models\BodegaProducto;
use App\Models\MovimientoBodega;
use App\Models\Producto;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class Ingreso extends Component
{
    use WithFileUploads;

    public $bodega_id;
    public $documento;
    public $observacion;
    public $factura;
    public $productos = [];
    public $bodegas = [];
    public $productosDisponibles = [];
    
    // Para controlar el estado de la carga
    public $isLoading = false;

    protected $rules = [
        'bodega_id' => 'required|exists:tbl_bodegas,id',
        'productos' => 'required|array|min:1',
        'productos.*.producto_id' => 'required|exists:tbl_productos,id',
        'productos.*.cantidad' => 'required|numeric|min:0.01',
        'documento' => 'nullable|string|max:50',
        'observacion' => 'nullable|string|max:500',
        'factura' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120'
    ];

    protected $messages = [
        'bodega_id.required' => 'Debe seleccionar una bodega',
        'productos.required' => 'Debe agregar al menos un producto',
        'productos.*.producto_id.required' => 'Seleccione un producto',
        'productos.*.cantidad.min' => 'La cantidad debe ser mayor a 0',
        'factura.max' => 'La factura no debe superar los 5MB'
    ];

    public function mount()
    {
        $this->bodegas = Bodega::all();
        $this->productosDisponibles = Producto::where('status', 'activo')->get();
        $this->agregarProducto();
    }

    public function agregarProducto()
    {
        $this->productos[] = [
            'producto_id' => '',
            'cantidad' => null
        ];
    }

    public function eliminarProducto($index)
    {
        if (count($this->productos) > 1) {
            unset($this->productos[$index]);
            $this->productos = array_values($this->productos);
        } else {                
            $this->dispatch('toast', type: 'error', message: 'Debe tener al menos un producto');
        }
    }

    public function updatedBodegaId()
    {
        // Resetear productos cuando cambia la bodega
        $this->productos = [];
        $this->agregarProducto();
    }

    public function save()
    {
        $this->validate();

        $this->isLoading = true;

        DB::beginTransaction();
        
        try {
            $facturaPath = null;
            
            // Guardar factura si se adjuntó
            if ($this->factura) {
                $facturaPath = $this->factura->store('facturas', 'public');
            }

            // Procesar cada producto
            foreach ($this->productos as $item) {
                $bodegaProducto = BodegaProducto::where('bodega', $this->bodega_id)
                    ->where('producto', $item['producto_id'])
                    ->first();
                
                $stockAnterior = $bodegaProducto ? $bodegaProducto->cantidad : 0;
                $nuevaCantidad = $stockAnterior + $item['cantidad'];
                
                // Actualizar o crear el registro en tbl_bodega_producto
                if ($bodegaProducto) {
                    $bodegaProducto->update(['cantidad' => $nuevaCantidad]);
                } else {
                    BodegaProducto::create([
                        'bodega' => $this->bodega_id,
                        'producto' => $item['producto_id'],
                        'cantidad' => $nuevaCantidad
                    ]);
                }
                
                // Registrar movimiento
                MovimientoBodega::create([
                    'bodega_id' => $this->bodega_id,
                    'producto_id' => $item['producto_id'],
                    'tipo' => 'ingreso',
                    'cantidad' => $item['cantidad'],
                    'stock_anterior' => $stockAnterior,
                    'stock_nuevo' => $nuevaCantidad,
                    'documento' => $this->documento,
                    'observacion' => $this->observacion,
                    'usuario_id' => Auth::id(),
                    'bodega_origen_id' => null,
                    'bodega_destino_id' => null
                ]);
            }
            
            DB::commit();
            
            $this->isLoading = false;
            
            // Resetear formulario
            $this->reset(['bodega_id', 'documento', 'observacion', 'factura', 'productos']);
            $this->agregarProducto();            
            $this->dispatch('toast', type: 'success', message: 'Ingreso de productos registrado exitosamente');
            
        } catch (\Exception $e) {
            DB::rollBack();
            $this->isLoading = false;
            
            // Eliminar factura si se guardó
            if (isset($facturaPath)) {
                Storage::disk('public')->delete($facturaPath);
            }            
            $this->dispatch('toast', type: 'error', message: 'Error al registrar el ingreso: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.bodega.ingreso');
    }
}