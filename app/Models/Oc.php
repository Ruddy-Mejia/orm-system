<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oc extends Model
{
    use HasFactory;

    protected $table = 'tbl_oc';

    protected $fillable = [
        'oc',
        'proveedor',
        'forma_pago',
        'convenio',
        'plazo_entrega',
        'monto_parcial',
        'monto_iva',
        'monto_total',
        'presupuesto',
        'factura',
        'observacion',
        'descuentos',
        'impuestos',
        'status',
        'cuotas',
        'terceros',
        'path_factura',
        'path_pago',
        'autorizaciones',
        'det_orm',
        'orm'
    ];

    protected $casts = [
        'status' => 'boolean',
        'terceros' => 'boolean',
        'det_orm' => 'array',
        'autorizaciones' => 'array',
        'monto_parcial' => 'decimal:2',
        'monto_iva' => 'decimal:2',
        'monto_total' => 'decimal:2',
        'presupuesto' => 'decimal:2',
        'descuentos' => 'decimal:2',
        'impuestos' => 'decimal:2',
    ];

    // Atributos por defecto
    protected $attributes = [
        'autorizaciones' => '[0,0,0]',
        'impuestos' => 0,
        'descuentos' => 0,
        'monto_parcial' => 0,
        'monto_iva' => 0,
        'monto_total' => 0,
        'cuotas' => 1,
        'status' => true,
        'terceros' => false,
    ];

    public function proveedorRel()
    {
        return $this->belongsTo(Proveedores::class, 'proveedor');
    }

    public function formapagoRel()
    {
        return $this->belongsTo(FormaPago::class, 'forma_pago');
    }

    public function convenioRel()
    {
        return $this->belongsTo(Convenio::class, 'convenio');
    }

    public function detormRel()
    {
        return $this->belongsTo(DetOrm::class, 'det_orm');
    }
    public function ormRel()
    {
        return $this->belongsTo(Orm::class, 'orm');
    }

    public function getAutorizacionesArrayAttribute()
    {
        return $this->autorizaciones ?? [0, 0, 0];
    }

    public static function generarNumeroOc()
    {
        $year = date('Y');

        $ultimo = self::orderBy('oc', 'desc')->first();

        if ($ultimo) {
            preg_match('/OC(\d+)-(\d{4})/', $ultimo->oc, $matches);
            $ultimoNumero = isset($matches[1]) ? intval($matches[1]) : 0;
            $ultimoAnio = isset($matches[2]) ? intval($matches[2]) : $year;

            if ($ultimoAnio == $year) {
                $nuevoNumero = $ultimoNumero + 1;
            } else {
                $nuevoNumero = 1;
            }
        } else {
            $nuevoNumero = 1;
        }

        return 'OC' . str_pad($nuevoNumero, 4, '0', STR_PAD_LEFT) . '-' . $year;
    }
}
