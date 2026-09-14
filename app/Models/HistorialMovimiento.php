<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialMovimiento extends Model
{
    protected $table = 'historial_movimientos';
    
    protected $fillable = [
        'user_id',
        'accion',
        'tabla',
        'registro_id',
        'descripcion',
        'datos_anteriores',
        'datos_nuevos',
        'ip',
        'user_agent',
        'url',
        'estado',
        'mensaje_error',
    ];

    protected $casts = [
        'datos_anteriores' => 'array',
        'datos_nuevos' => 'array',
    ];

    // Relación con el usuario que realizó la acción
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Scope para filtrar por acción
    public function scopeAccion($query, $accion)
    {
        return $query->where('accion', $accion);
    }

    // Scope para filtrar por tabla
    public function scopeTabla($query, $tabla)
    {
        return $query->where('tabla', $tabla);
    }

    // Scope para filtrar por usuario
    public function scopeUsuario($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Scope para filtrar por fecha
    public function scopeFecha($query, $fechaInicio, $fechaFin = null)
    {
        $query->whereDate('created_at', '>=', $fechaInicio);
        if ($fechaFin) {
            $query->whereDate('created_at', '<=', $fechaFin);
        }
        return $query;
    }
}