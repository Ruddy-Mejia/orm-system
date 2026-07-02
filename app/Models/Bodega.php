<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bodega extends Model
{
    use HasFactory;
    protected $table = 'tbl_bodegas';
    
    protected $fillable = ['sitio', 'nombre'];
    
    public function sitioRel(): BelongsTo
    {
        return $this->belongsTo(Sitio::class, 'sitio');
    }
    
    public function bodegaProductosRel(): HasMany
    {
        return $this->hasMany(BodegaProducto::class, 'bodega');
    }
    public function productosRel()
    {
        return $this->belongsToMany(Producto::class, 'tbl_bodega_producto', 'bodega', 'producto')
                    ->withPivot('cantidad')
                    ->withTimestamps();
    }

    public function movimientosRel()
    {
        return $this->hasMany(MovimientoBodega::class, 'bodega_id');
    }
}