<?php
// app/Livewire/Acquisitions/Orm/CreateOrm.php

namespace App\Livewire\Acquisitions\Orm;

use App\Models\Producto;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Orm;
use App\Models\DetOrm;
use App\Models\Cdc;
use App\Models\Adn;
use App\Models\Sitio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrmCreate extends Component
{
    use WithFileUploads;

    // Datos del formulario
    public $descrip_orm = '';
    public $id_adn = '';
    public $id_sitio = '';
    public $tipo = '';
    public $patente = '';
    public $serv3ros = false;
    public $archivo_orm = null;
    public $observacion_orm = '';
    public $items = [];

    // --- CDC autocomplete ---
    public $cdc_busqueda = '';
    public $id_cdc = '';
    public $descripcion = '';
    public $cdc_sugerencias = [];
    public $mostrar_sugerencias_cdc = false;
    // Guarda el texto exacto del CDC ya seleccionado, para detectar
    // si el usuario lo modificó sin volver a elegir uno de la lista.
    protected $cdc_texto_seleccionado = '';

    // --- Producto autocomplete ---
    public $producto_busqueda = '';
    public $productos_sugeridos = [];
    public $mostrar_sugerencias = false;

    public $generando_orm = false;

    // Mínimo de caracteres antes de consultar la BD (rendimiento con +1000 registros)
    const MIN_CHARS_CDC = 2;
    const MIN_CHARS_PRODUCTO = 3;

    protected $rules = [
        'descrip_orm' => 'required|string|max:500',
        'id_adn' => 'required|exists:tbl_adn,id',
        'id_sitio' => 'required|exists:tbl_sitios,id',
        'tipo' => 'required',
        'cdc_busqueda' => 'required|string',
        'id_cdc' => 'required|exists:tbl_cdc,id',
        'patente' => 'nullable|string',
        'serv3ros' => 'boolean',
        'archivo_orm' => 'nullable|file|max:5120|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,tif,tiff',
        'observacion_orm' => 'nullable|string',
        'items' => 'required|array|min:1',
        'items.*.id' => 'required|exists:tbl_productos,id',
    ];

    protected $messages = [
        'descrip_orm.required' => 'La descripción es obligatoria',
        'id_adn.required' => 'Debe seleccionar un Área de Negocio',
        'id_sitio.required' => 'Debe seleccionar un Sitio',
        'tipo.required' => 'Debe seleccionar un Tipo de ORM',
        'cdc_busqueda.required' => 'Debe seleccionar un CDC',
        'id_cdc.required' => 'Debe seleccionar un CDC válido de la lista',
        'patente.regex' => 'Formato de patente inválido. Ejemplo: AB-CD-12',
        'archivo_orm.max' => 'El archivo no debe superar los 5MB',
        'archivo_orm.mimes' => 'Formato de archivo no permitido',
        'items.required' => 'Debe agregar al menos un producto',
    ];

    public function mount()
    {
        $this->items = [];
    }


    public function seleccionarCdc($id)
    {
        $cdc = Cdc::find($id);
        if ($cdc) {
            $this->id_cdc = $cdc->id;
            $this->cdc_busqueda = $cdc->cdc;
            $this->cdc_texto_seleccionado = $cdc->cdc;
            $this->descripcion = $cdc->descripcion ?? '';
            $this->cdc_sugerencias = [];
            $this->mostrar_sugerencias_cdc = false;
        }
    }
    public function updatedCdcBusqueda($value)
    {
        $this->resetErrorBag('cdc_busqueda');

        if ($this->id_cdc && $value !== $this->cdc_texto_seleccionado) {
            $this->id_cdc = '';
            $this->descripcion = '';
        }

        if (strlen(trim($value)) < self::MIN_CHARS_CDC) {
            $this->cdc_sugerencias = [];
            $this->mostrar_sugerencias_cdc = false;
            return;
        }

        $this->cdc_sugerencias = Cdc::where('cdc', 'like', '%' . $value . '%')
            ->limit(10)
            ->get();
        $this->mostrar_sugerencias_cdc = !empty($this->cdc_sugerencias);
    }

    public function cerrarSugerenciasCdc()
    {
        $this->mostrar_sugerencias_cdc = false;
    }

    public function updatedProductoBusqueda($value)
    {
        if (strlen(trim($value)) < self::MIN_CHARS_PRODUCTO) {
            $this->productos_sugeridos = [];
            $this->mostrar_sugerencias = false;
            return;
        }

        $this->productos_sugeridos = Producto::where('nombre', 'like', '%' . $value . '%')
            ->limit(10)
            ->get();

        $this->mostrar_sugerencias = !empty($this->productos_sugeridos);
    }

    public function seleccionarProducto($id)
    {        
        $producto = Producto::find($id);

        if ($producto) {
            $existe = collect($this->items)->contains('id', $producto->id);

            if (!$existe) {
                $this->items[] = [
                    'id' => $producto->id,
                    'name' => $producto->nombre,
                    'unit' => $producto->unidad ?? 'N/A',
                    'cantidad' => 1,
                    'extra' => '',
                ];
            }
        }

        $this->producto_busqueda = '';
        $this->productos_sugeridos = [];
        $this->mostrar_sugerencias = false;
    }

    public function cerrarSugerenciasProducto()
    {
        $this->mostrar_sugerencias = false;
    }


    public function eliminarItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }


    public function save()
    {
        $this->validate();

        $this->generando_orm = true;

        DB::beginTransaction();

        try {
            $numeroOrm = Orm::generarNumeroOrm();

            $archivoPath = null;
            if ($this->archivo_orm) {
                $extension = $this->archivo_orm->getClientOriginalExtension();
                $nombreArchivo = 'orm_' . str_replace('-', '_', $numeroOrm) . '.' . $extension;
                $archivoPath = $this->archivo_orm->storeAs('orm_documents', $nombreArchivo, 'public');
            }

            Orm::create([
                'orm' => $numeroOrm,
                'responsable' => Auth::id(),
                'comprador' => null,
                'cdc' => $this->id_cdc,
                'adn' => $this->id_adn,
                'sitio' => $this->id_sitio,
                'status' => 0,
                'terceros' => $this->serv3ros,
                'tipo' => $this->tipo,
                'descripcion' => $this->descrip_orm,
                'patente' => strtoupper($this->patente) ? : null,
                'archivo' => $archivoPath,
                'obs_orm' => strtoupper($this->observacion_orm),
            ]);

            foreach ($this->items as $item) {
                DetOrm::create([
                    'orm' => $numeroOrm,
                    'cantidad' => $item['cantidad'],
                    'detalle' => $item['extra'] ?? '',
                    'producto' => $item['id'],
                ]);
            }

            DB::commit();
            
            $this->dispatch('toast', type: 'success', message: 'ORM creado exitosamente con número: ' . $numeroOrm ,route: route('view', $numeroOrm));              

            // return redirect()->route('view', $numeroOrm);//<---------------------------------

        } catch (\Throwable $e) {
            DB::rollBack();
            $this->generando_orm = false;
            $this->dispatch('toast', type: 'error', message: 'Error al crear ORM: ' . $e->getMessage());            
        }
    }

    public function render()
    {
        return view('livewire.acquisitions.orm.orm-create', [
            'adnList' => Adn::orderBy('descripcion')->get(),
            'sitioList' => Sitio::orderBy('descripcion')->get(),
        ]);
    }
}
