<?php
// app/Livewire/Bodega/Traspaso.php

namespace App\Livewire\Bodega;

use App\Models\Bodega;
use App\Models\BodegaProducto;
use App\Models\MovimientoBodega;
use App\Models\Producto;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class Traspaso extends Component
{
    public $bodega_origen_id;
    public $bodega_destino_id;
    public $observacion;
    public $productos = [];
    public $bodegas = [];
    public $productosOrigen = [];
    public $isLoading = false;

    protected $rules = [
        'bodega_origen_id' => 'required|exists:tbl_bodegas,id',
        'bodega_destino_id' => 'required|exists:tbl_bodegas,id|different:bodega_origen_id',
        'productos' => 'required|array|min:1',
        'productos.*.producto_id' => 'required|exists:tbl_productos,id',
        'productos.*.cantidad' => 'required|numeric|min:0.01|max:999999.99',
        'observacion' => 'nullable|string|max:500'
    ];

    protected $messages = [
        'bodega_origen_id.required' => 'Debe seleccionar la bodega de origen',
        'bodega_destino_id.required' => 'Debe seleccionar la bodega de destino',
        'bodega_destino_id.different' => 'Las bodegas de origen y destino deben ser diferentes',
        'productos.required' => 'Debe agregar al menos un producto',
        'productos.*.cantidad.min' => 'La cantidad debe ser mayor a 0',
    ];

    public function mount()
    {
        $this->bodegas = Bodega::all();
        $this->agregarProducto();
    }

    public function agregarProducto()
    {
        $this->productos[] = [
            'producto_id' => '',
            'cantidad' => null,
            'stock_disponible' => 0,
            'nombre_producto' => ''
        ];
    }

    public function eliminarProducto($index)
    {
        if (count($this->productos) > 1) {
            unset($this->productos[$index]);
            $this->productos = array_values($this->productos);
        } else {            
            $this->dispatch('toast', type: 'error', message: "Debe tener al menos un producto");
        }
    }

    public function updatedBodegaOrigenId()
    {
        $this->cargarProductosOrigen();
        // Resetear productos seleccionados
        $this->productos = [];
        $this->agregarProducto();
    }

    public function updatedBodegaDestinoId()
    {
        // Validar que no sea la misma
        if ($this->bodega_origen_id == $this->bodega_destino_id) {
            $this->dispatch('toast', type: 'error', message: "Las bodegas de origen y destino deben ser diferentes");
            $this->bodega_destino_id = null;
        }
    }

    public function updatedProductos($value, $key)
    {
        // Cuando se selecciona un producto, obtener su stock disponible
        $parts = explode('.', $key);
        if (count($parts) === 2 && $parts[1] === 'producto_id') {
            $index = $parts[0];
            $productoId = $value;
            
            if ($productoId && $this->bodega_origen_id) {
                $stock = BodegaProducto::where('bodega', $this->bodega_origen_id)
                    ->where('producto', $productoId)
                    ->first();
                
                $this->productos[$index]['stock_disponible'] = $stock ? $stock->cantidad : 0;
                
                // Obtener nombre del producto
                $producto = Producto::find($productoId);
                $this->productos[$index]['nombre_producto'] = $producto ? $producto->nombre : '';
            }
        }
    }

    public function cargarProductosOrigen()
    {
        if ($this->bodega_origen_id) {
            $this->productosOrigen = BodegaProducto::where('bodega', $this->bodega_origen_id)
                ->with('productoRel')
                ->where('cantidad', '>', 0)
                ->get()
                ->map(function($item) {
                    return [
                        'id' => $item->productoRel->id,
                        'nombre' => $item->productoRel->nombre,
                        'stock' => $item->cantidad,
                        'unidad' => $item->productoRel->unidad ?? ''
                    ];
                });
        } else {
            $this->productosOrigen = [];
        }
    }

    public function save()
    {
        $this->validate();

        // Validar stock suficiente para cada producto
        foreach ($this->productos as $item) {
            $stock = BodegaProducto::where('bodega', $this->bodega_origen_id)
                ->where('producto', $item['producto_id'])
                ->first();
            
            if (!$stock || $stock->cantidad < $item['cantidad']) {
                $this->dispatch('toast', type: 'error', message: "Stock insuficiente para el producto seleccionado. Disponible: " . ($stock ? $stock->cantidad : 0));
                return;
            }
        }

        $this->isLoading = true;

        DB::beginTransaction();
        
        try {
            foreach ($this->productos as $item) {
                // Descontar de origen
                $bodegaOrigenProducto = BodegaProducto::where('bodega', $this->bodega_origen_id)
                    ->where('producto', $item['producto_id'])
                    ->first();
                
                $stockAnteriorOrigen = $bodegaOrigenProducto->cantidad;
                $nuevoStockOrigen = $stockAnteriorOrigen - $item['cantidad'];
                $bodegaOrigenProducto->update(['cantidad' => $nuevoStockOrigen]);
                
                // Registrar movimiento de salida en origen
                MovimientoBodega::create([
                    'bodega_id' => $this->bodega_origen_id,
                    'producto_id' => $item['producto_id'],
                    'tipo' => 'traspaso_salida',
                    'cantidad' => $item['cantidad'],
                    'stock_anterior' => $stockAnteriorOrigen,
                    'stock_nuevo' => $nuevoStockOrigen,
                    'observacion' => $this->observacion,
                    'usuario_id' => Auth::id(),
                    'bodega_origen_id' => $this->bodega_origen_id,
                    'bodega_destino_id' => $this->bodega_destino_id
                ]);
                
                // Agregar a destino
                $bodegaDestinoProducto = BodegaProducto::where('bodega', $this->bodega_destino_id)
                    ->where('producto', $item['producto_id'])
                    ->first();
                
                $stockAnteriorDestino = $bodegaDestinoProducto ? $bodegaDestinoProducto->cantidad : 0;
                $nuevoStockDestino = $stockAnteriorDestino + $item['cantidad'];
                
                if ($bodegaDestinoProducto) {
                    $bodegaDestinoProducto->update(['cantidad' => $nuevoStockDestino]);
                } else {
                    BodegaProducto::create([
                        'bodega' => $this->bodega_destino_id,
                        'producto' => $item['producto_id'],
                        'cantidad' => $nuevoStockDestino
                    ]);
                }
                
                // Registrar movimiento de entrada en destino
                MovimientoBodega::create([
                    'bodega_id' => $this->bodega_destino_id,
                    'producto_id' => $item['producto_id'],
                    'tipo' => 'traspaso_entrada',
                    'cantidad' => $item['cantidad'],
                    'stock_anterior' => $stockAnteriorDestino,
                    'stock_nuevo' => $nuevoStockDestino,
                    'observacion' => $this->observacion,
                    'usuario_id' => Auth::id(),
                    'bodega_origen_id' => $this->bodega_origen_id,
                    'bodega_destino_id' => $this->bodega_destino_id
                ]);
            }
            
            DB::commit();
            
            $this->isLoading = false;
            
            // Resetear formulario
            $this->reset(['bodega_origen_id', 'bodega_destino_id', 'observacion', 'productos']);
            $this->agregarProducto();
            $this->productosOrigen = [];            
            $this->dispatch('toast', type: 'success', message: 'Traspaso realizado exitosamente');
            
        } catch (\Exception $e) {
            DB::rollBack();
            $this->isLoading = false;
            
            $this->dispatch('toast', type: 'error', message: 'Error al realizar el traspaso: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.bodega.traspaso');
    }
}