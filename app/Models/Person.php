<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Person extends Model
{
    use HasFactory;

    protected $table = 'tbl_person';

    protected $fillable = [
        'rut',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'genero',
        'direccion',
        'ciudad',
        'nacionalidad',
        'estado_civil',
        'email',
        'telefono',
        'cargo',
        'fecha_ingreso',
        'empresa',
        'sitio',
    ];

    public function users(): HasOne
    {
        return $this->hasOne(User::class, 'person_id');
    }
    public function sitioRel(): BelongsTo
    {
        return $this->belongsTo(Sitio::class, 'sitio_id');
    }
}