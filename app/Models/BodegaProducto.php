<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BodegaProducto extends Model
{
    use HasFactory;
    protected $table = 'tbl_bodega_producto';
    
    protected $fillable = ['bodega', 'producto', 'cantidad'];

    protected $casts = [
        'cantidad' => 'float'
    ];

    
    public function bodegaRel(): BelongsTo
    {
        return $this->belongsTo(Bodega::class, 'bodega');
    }
    
    public function productoRel(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'producto');
    }
}