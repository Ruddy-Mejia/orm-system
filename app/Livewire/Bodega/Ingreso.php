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
    public $isLoading = false;

    // Propiedades para el autocomplete de productos
    public $producto_busqueda = '';
    public $productos_sugeridos = [];
    public $mostrar_sugerencias_producto = false;

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
        $this->agregarProducto();
    }

    /**
     * Se ejecuta automáticamente cuando cambia producto_busqueda
     */
    public function updatedProductoBusqueda($value)
    {            
        if (strlen(trim($value)) < 2) {
            $this->productos_sugeridos = [];
            $this->mostrar_sugerencias_producto = false;
            return;
        }

        $this->productos_sugeridos = Producto::where('nombre', 'like', '%' . $value . '%')
            ->limit(10)
            ->get();

        $this->mostrar_sugerencias_producto = !empty($this->productos_sugeridos);
    }

    /**
     * Abrir sugerencias al hacer focus
     */
    public function abrirSugerenciasProducto()
    {
        if (strlen(trim($this->producto_busqueda)) >= 2) {
            $this->updatedProductoBusqueda($this->producto_busqueda);
        }
    }

    /**
     * Cerrar sugerencias al perder el foco
     */
    public function cerrarSugerenciasProducto()
    {
        // Pequeño retraso para permitir que el click en la sugerencia se procese
        $this->mostrar_sugerencias_producto = false;
        $this->productos_sugeridos = [];
    }

    /**
     * Seleccionar un producto de las sugerencias
     */
    public function seleccionarProducto($index, $productoId)
    {
        $producto = Producto::find($productoId);
        if ($producto) {
            $this->productos[$index]['producto_id'] = $producto->id;
            $this->productos[$index]['nombre_producto'] = $producto->nombre;

            // Limpiar búsqueda
            $this->producto_busqueda = '';
            $this->productos_sugeridos = [];
            $this->mostrar_sugerencias_producto = false;
        }
    }

    /**
     * Quitar el producto seleccionado
     */
    public function quitarProductoSeleccionado($index)
    {
        $this->productos[$index]['producto_id'] = '';
        $this->productos[$index]['nombre_producto'] = '';
        $this->producto_busqueda = '';
        $this->productos_sugeridos = [];
        $this->mostrar_sugerencias_producto = false;
    }

    public function agregarProducto()
    {
        $this->productos[] = [
            'producto_id' => '',
            'cantidad' => null,
            'nombre_producto' => ''
        ];
    }

    public function eliminarProducto($index)
    {
        if (isset($this->productos[$index])) {
            if (count($this->productos) <= 1) {
                $this->dispatch('toast', type: 'error', message: 'Debe tener al menos un producto');
                return;
            }

            unset($this->productos[$index]);
            $this->productos = array_values($this->productos);
        }
    }

    public function updatedBodegaId()
    {
        $this->productos = [];
        $this->agregarProducto();
    }



    // ============ GUARDAR ============

    public function save()
    {
        $this->validate();

        // Verificar que todos los productos tengan ID
        foreach ($this->productos as $item) {
            if (empty($item['producto_id'])) {
                $this->dispatch('toast', type: 'error', message: 'Todos los productos deben estar seleccionados correctamente');
                return;
            }
        }

        $this->isLoading = true;

        DB::beginTransaction();

        try {
            $facturaPath = null;

            if ($this->factura) {
                $facturaPath = $this->factura->store('facturas', 'public');
            }

            foreach ($this->productos as $item) {
                $bodegaProducto = BodegaProducto::where('bodega', $this->bodega_id)
                    ->where('producto', $item['producto_id'])
                    ->first();

                $stockAnterior = $bodegaProducto ? $bodegaProducto->cantidad : 0;
                $nuevaCantidad = $stockAnterior + $item['cantidad'];

                if ($bodegaProducto) {
                    $bodegaProducto->update(['cantidad' => $nuevaCantidad]);
                } else {
                    BodegaProducto::create([
                        'bodega' => $this->bodega_id,
                        'producto' => $item['producto_id'],
                        'cantidad' => $nuevaCantidad
                    ]);
                }

                MovimientoBodega::create([
                    'bodega_id' => $this->bodega_id,
                    'producto_id' => $item['producto_id'],
                    'tipo' => 'ingreso',
                    'cantidad' => $item['cantidad'],
                    'stock_anterior' => $stockAnterior,
                    'stock_nuevo' => $nuevaCantidad,
                    'documento' => $this->documento,
                    'documento_path' => $facturaPath,
                    'observacion' => $this->observacion,
                    'usuario_id' => Auth::id(),
                    'bodega_origen_id' => null,
                    'bodega_destino_id' => null
                ]);
            }

            DB::commit();

            $this->isLoading = false;

            $this->reset(['bodega_id', 'documento', 'observacion', 'factura', 'productos', 'producto_busqueda']);
            $this->agregarProducto();
            $this->dispatch('toast', type: 'success', message: 'Ingreso de productos registrado exitosamente', route: route('bodegas.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            $this->isLoading = false;

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
