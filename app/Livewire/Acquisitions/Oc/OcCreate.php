<?php

namespace App\Livewire\Acquisitions\Oc;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Oc;
use App\Models\Proveedores;
use App\Models\FormaPago;
use App\Models\Convenio;
use App\Models\DetOrm;
use App\Models\Ciudad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class OcCreate extends Component
{
    use WithFileUploads;
    public $proveedorId;
    public $detallesIds;
    public $productos = [];

    // Para la vista funcional
    public $proveedor_nombre = '';
    public $subtotal_productos = 0;
    public $base_imponible = 0;

    // Datos básicos
    public $oc_numero;
    public $responsable;
    public $proveedor;
    public $adn;
    public $cdc;
    public $forma_pago;
    public $convenio;
    public $plazo_entrega;
    public $orm_seleccionada;

    // Datos financieros
    public $monto_parcial = 0;
    public $monto_iva = 0;
    public $monto_total = 0;
    public $presupuesto;
    public $descuentos = 0;
    public $impuestos = 0;

    // Otros campos
    public $factura;
    public $observacion;
    public $cuotas = 1;
    public $terceros = false;
    public $status = true;

    // Archivos
    public $path_factura;
    public $path_pago;

    // Autorizaciones
    public $autorizaciones = [0, 0, 0];

    // Lists para selects
    public $proveedores_list = [];
    public $adn_list = [];
    public $cdc_list = [];
    public $forma_pago_list = [];
    public $convenio_list = [];
    public $orm_list = [];
    public $ciudades = [];

    // Flags
    public $generando_oc = false;

    protected $rules = [
        'forma_pago' => 'required|exists:tbl_forma_pago,id',
        'convenio' => 'nullable|exists:tbl_convenio,id',
        'plazo_entrega' => 'required|integer|min:1|max:365',
        'orm_seleccionada' => 'nullable|exists:tbl_orm,orm',
        'monto_parcial' => 'required|numeric|min:0',
        'monto_iva' => 'required|numeric|min:0',
        'monto_total' => 'required|numeric|min:0',
        'presupuesto' => 'nullable|numeric|min:0',
        'descuentos' => 'nullable|numeric',
        'impuestos' => 'nullable|numeric',
        'factura' => 'nullable|string|max:100',
        'observacion' => 'nullable|string|max:500',
        'cuotas' => 'required|integer|min:1|max:36',
        'terceros' => 'boolean',
        'status' => 'boolean',
        'path_factura' => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png',
        'path_pago' => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png',
        'autorizaciones' => 'array|size:3',
        'autorizaciones.*' => 'in:0,1',
    ];

    protected $messages = [
        'forma_pago.required' => 'Debe seleccionar una forma de pago',
        'plazo_entrega.required' => 'Debe ingresar el plazo de entrega',
        'monto_parcial.required' => 'Debe ingresar el monto parcial',
        'cuotas.min' => 'Las cuotas deben ser al menos 1',
    ];

    public function mount($detalles = null)
    {
        $this->detallesIds = $detalles;
        $this->loadLists();

        // Cargar productos desde DetOrm
        if ($this->detallesIds) {
            $ids = explode(',', $this->detallesIds);
            $detallesOrm = DetOrm::with('productoRel')->whereIn('id', $ids)->get();

            foreach ($detallesOrm as $detalle) {
                $this->productos[] = [
                    'id' => $detalle->id,
                    'producto_id' => $detalle->producto_id,
                    'nombre' => $detalle->productoRel->nombre,
                    'detalle' => $detalle->productoRel->detalle,
                    'cantidad' => $detalle->cantidad,
                    'unidad' => $detalle->productoRel->unidad ?? 'N/A',
                    'precio' => 0,
                    'subtotal' => 0,
                ];
            }
        }
    }

    public function loadLists()
    {   
        $this->ciudades = Ciudad::orderBy('nombre')->get();
        $this->proveedores_list = Proveedores::get();
        $this->forma_pago_list = FormaPago::where('status', true)->get();
        $this->convenio_list = Convenio::where('status', true)->get();
    }

    public function calculateTotals()
    {
        $parcial = floatval($this->monto_parcial);
        $descuentos = floatval($this->descuentos);
        $impuestos = floatval($this->impuestos);

        $this->monto_iva = $parcial * 0.19;
        $this->monto_total = $parcial - $descuentos + $impuestos + $this->monto_iva;

        $this->monto_total = max(0, $this->monto_total);
    }

    public function save()
    {
        $idsArray = explode(',', $this->detallesIds);
        // dd(gettype(json_encode($idsArray)));

        DB::beginTransaction();
        try {
            $validated = $this->validate();

            $facturaPath = null;
            if ($this->path_factura) {
                $facturaPath = $this->path_factura->store('oc_facturas', 'public');
            }

            $pagoPath = null;
            if ($this->path_pago) {
                $pagoPath = $this->path_pago->store('oc_pagos', 'public');
            }

            // Generar número de OC
            $numeroOc = Oc::generarNumeroOc();

            // Crear una sola OC para todos los productos seleccionados
            $oc = Oc::create([
                'oc' => $numeroOc,
                'responsable' => Auth::id(),
                'proveedor' => $this->proveedor,
                'forma_pago' => $this->forma_pago,
                'convenio' => $this->convenio ?: null,
                'plazo_entrega' => $this->plazo_entrega,
                'monto_parcial' => $this->monto_parcial,
                'monto_iva' => $this->monto_iva,
                'monto_total' => $this->monto_total,
                'presupuesto' => $this->presupuesto,
                'factura' => $this->factura,
                'observacion' => $this->observacion,
                'descuentos' => $this->descuentos,
                'impuestos' => $this->impuestos,
                'cuotas' => $this->cuotas,
                'terceros' => $this->terceros,
                'status' => $this->status,
                'path_factura' => $facturaPath,
                'path_pago' => $pagoPath,
                'autorizaciones' => json_encode($this->autorizaciones),
                'det_orm' => json_encode($idsArray),
                'orm' => DetOrm::find($idsArray[0])->orm,
            ]);

            foreach ($this->productos as $item) {
                DetOrm::where('id', $item['id'])->update([
                    'costo' => floatval($item['precio']),
                    'f_estimada' => $item['f_estimada'] ?? null,
                    'ciudad' => $item['ciudad'] ?? null, 
                ]);
            }

            DB::commit();
            $this->dispatch('toast', type: 'success', message: "Orden de Compra creada exitosamente: {$numeroOc}");            

            return redirect()->route('oc.show', $numeroOc);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear OC: ' . $e->getMessage());            
            $this->dispatch('toast', type: 'error', message: "Error al crear OC: " . $e->getMessage());
            $this->generando_oc = false;
        }
    }

    public function updatedProductos()
    {
        $this->calculateSubtotal();
    }

    public function calculateSubtotal()
    {
        $this->subtotal_productos = 0;
        foreach ($this->productos as $index => $item) {
            $precio = floatval($item['precio'] ?? 0);
            $cantidad = floatval($item['cantidad'] ?? 1);
            $this->subtotal_productos += $precio * $cantidad;
        }
        $this->monto_parcial = $this->subtotal_productos;
        $this->calculateTotals();
        $this->base_imponible = $this->monto_parcial - floatval($this->descuentos) + floatval($this->impuestos);
    }

    public function updatedDescuentos()
    {
        $this->base_imponible = $this->monto_parcial - floatval($this->descuentos) + floatval($this->impuestos);
        $this->calculateTotals();
    }

    public function updatedImpuestos()
    {
        $this->base_imponible = $this->monto_parcial - floatval($this->descuentos) + floatval($this->impuestos);
        $this->calculateTotals();
    }

    public function render()
    {
        return view('livewire.acquisitions.oc.oc-create');
    }
}
