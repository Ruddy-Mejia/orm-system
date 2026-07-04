<?php
// app/Livewire/Dashboard.php

namespace App\Livewire;

use App\Models\Bodega;
use App\Models\BodegaProducto;
use App\Models\Categoria;
use App\Models\MovimientoBodega;
use App\Models\Oc;
use App\Models\Orm;
use App\Models\Producto;
use App\Models\Proveedores;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public $totalProductos = 0;
    public $totalBodegas = 0;
    public $totalOrm = 0;
    public $totalOc = 0;
    public $totalProveedores = 0;
    public $totalCategorias = 0;
    public $ocMensual;

    // Datos para gráficos
    public $movimientosPorTipo = [];
    public $bodegasLabels = [];
    public $bodegasData = [];
    public $mesesLabels = [];
    public $movimientosMensuales = [];

    // Datos financieros
    public $montoTotalOc = 0;
    public $montoTotalOrm = 0;
    public $promedioOc = 0;
    public $ocPorStatus = [];
    public $ormPorStatus = [];
    public $comprasPorProveedor = [];
    public $productosPorCategoria = [];
    public $topProductos = [];
    public $topProveedores = [];

    public function mount()
    {
        $this->cargarDatos();
    }

    public function cargarDatos()
    {
        $anioActual = Carbon::now()->year;

        // ============ TOTALES ============
        $this->totalProductos = Producto::count();
        $this->totalBodegas = Bodega::count();
        $this->totalOrm = Orm::count();
        $this->totalOc = Oc::count();
        $this->totalProveedores = Proveedores::count();
        $this->totalCategorias = Categoria::count();

        // ============ FINANCIEROS ============
        $this->montoTotalOc = Oc::sum('monto_total') ?? 0;
        $this->montoTotalOrm = 0;
        $this->promedioOc = Oc::avg('monto_total') ?? 0;

        // ============ OC POR STATUS ============
        $ocStatusRaw = Oc::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        // Mapear los valores numéricos a textos
        $statusOcMap = [
            0 => 'No Procesado',
            1 => 'En Procesado',
            // Agrega más según tus status
        ];

        $this->ocPorStatus = [];
        foreach ($ocStatusRaw as $key => $value) {
            $label = $statusOcMap[$key] ?? 'Estado ' . $key;
            $this->ocPorStatus[$label] = $value;
        }

        // ============ ORM POR STATUS ============
        $ormStatusRaw = Orm::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        // Mapear los valores numéricos a textos
        $statusOrmMap = [
            0 => 'Sin Atención',
            1 => 'En Atención',
            // Agrega más según tus status
        ];

        $this->ormPorStatus = [];
        foreach ($ormStatusRaw as $key => $value) {
            $label = $statusOrmMap[$key] ?? 'Estado ' . $key;
            $this->ormPorStatus[$label] = $value;
        }

        // ============ COMPRAS POR PROVEEDOR ============
        $this->comprasPorProveedor = Oc::select('proveedor', DB::raw('count(*) as total_oc'), DB::raw('sum(monto_total) as total_monto'))
            ->with('proveedorRel')
            ->groupBy('proveedor')
            ->orderBy('total_monto', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                return [
                    'nombre' => $item->proveedorRel->nombre ?? 'N/A',
                    'total_oc' => $item->total_oc,
                    'total_monto' => $item->total_monto
                ];
            })
            ->toArray();

        // ============ TOP 5 PROVEEDORES ============
        $this->topProveedores = Oc::select('proveedor', DB::raw('sum(monto_total) as total_monto'))
            ->with('proveedorRel')
            ->groupBy('proveedor')
            ->orderBy('total_monto', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'nombre' => $item->proveedorRel->razon_social ?? 'N/A',
                    'total_monto' => $item->total_monto
                ];
            })
            ->toArray();

        // ============ PRODUCTOS POR CATEGORÍA ============
        $this->productosPorCategoria = Producto::select('categoria', DB::raw('count(*) as total'))
            ->whereNotNull('categoria')
            ->groupBy('categoria')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                $categoria = Categoria::find($item->categoria);
                return [
                    'nombre' => $categoria->nombre ?? 'N/A',
                    'total' => $item->total
                ];
            })
            ->toArray();

        // ============ TOP 10 PRODUCTOS MÁS MOVIDOS ============
        $this->topProductos = MovimientoBodega::select('producto_id', DB::raw('sum(cantidad) as total_movido'))
            ->with('productoRel')
            ->groupBy('producto_id')
            ->orderBy('total_movido', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($item) {
                return [
                    'nombre' => $item->productoRel->nombre ?? 'N/A',
                    'total_movido' => $item->total_movido
                ];
            })
            ->toArray();

        // ============ MOVIMIENTOS POR TIPO ============
        $this->movimientosPorTipo = MovimientoBodega::select('tipo', DB::raw('count(*) as total'))
            ->groupBy('tipo')
            ->pluck('total', 'tipo')
            ->toArray();

        // ============ PRODUCTOS POR BODEGA ============
        $bodegas = Bodega::withCount(['bodegaProductosRel as total_productos' => function ($query) {
            $query->where('cantidad', '>', 0);
        }])->get();

        $this->bodegasLabels = $bodegas->pluck('nombre')->toArray();
        $this->bodegasData = $bodegas->pluck('total_productos')->toArray();

        // ============ MOVIMIENTOS MENSUALES (ÚLTIMOS 12 MESES) ============
        $meses = collect(range(11, 0))->map(function ($i) {
            return Carbon::now()->subMonths($i);
        });

        $this->mesesLabels = $meses->map(function ($fecha) {
            return $fecha->format('M Y');
        })->toArray();

        $this->movimientosMensuales = $meses->map(function ($fecha) {
            return MovimientoBodega::whereMonth('created_at', $fecha->month)
                ->whereYear('created_at', $fecha->year)
                ->count();
        })->toArray();

        // ============ EVOLUCIÓN MENSUAL DE OC ============
        $this->ocMensual = $meses->map(function ($fecha) {
            return Oc::whereMonth('created_at', $fecha->month)
                ->whereYear('created_at', $fecha->year)
                ->sum('monto_total') ?? 0;
        })->toArray();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}