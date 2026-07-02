<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_proveedores';
    
    protected $fillable = [
        'rut',
        'razon_social',
        'status'
    ];
    
    protected $casts = [
        'status' => 'boolean',
    ];
    
    // Relación con OC
    public function ocs()
    {
        return $this->hasMany(Oc::class, 'proveedor');
    }
    
    // Mutador para limpiar RUT
    public function setRutAttribute($value)
    {
        $this->attributes['rut'] = preg_replace('/[^0-9kK]/', '', $value);
    }
    
    // Scope para proveedores activos
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}