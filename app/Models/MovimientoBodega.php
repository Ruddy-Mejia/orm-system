<?php
// app/Models/MovimientoBodega.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoBodega extends Model
{
    use HasFactory;

    protected $table = 'tbl_movimientos_bodega';

    protected $fillable = [
        'bodega_id',
        'producto_id',
        'tipo',
        'cantidad',
        'stock_anterior',
        'stock_nuevo',
        'documento',
        'documento_path',
        'observacion',
        'usuario_id',
        'bodega_origen_id',
        'bodega_destino_id'
    ];

    protected $casts = [
        'cantidad' => 'float',
        'stock_anterior' => 'float',
        'stock_nuevo' => 'float'
    ];

    // Relaciones
    public function bodegaRel()
    {
        return $this->belongsTo(Bodega::class, 'bodega_id');
    }

    public function productoRel()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function usuarioRel()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function bodegaOrigenRel()
    {
        return $this->belongsTo(Bodega::class, 'bodega_origen_id');
    }

    public function bodegaDestinoRel()
    {
        return $this->belongsTo(Bodega::class, 'bodega_destino_id');
    }
}
