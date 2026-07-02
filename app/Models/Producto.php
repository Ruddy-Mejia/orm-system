<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'tbl_productos';
    
    protected $fillable = ['nombre', 'unidad', 'categoria', 'status'];
    
    protected $casts = [
        'status' => 'boolean',
    ];
    
    public function categoriaRel(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria');
    }
    
    public function bodegaProductos(): HasMany
    {
        return $this->hasMany(BodegaProducto::class, 'producto');
    }
    
    public function detallesOrm(): HasMany
    {
        return $this->hasMany(DetOrm::class, 'id');
    }
}