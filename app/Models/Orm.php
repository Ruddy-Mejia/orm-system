<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Orm extends Model
{
    use HasFactory;
    protected $table = 'tbl_orm';
    protected $primaryKey = 'orm';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'orm',
        'responsable',
        'comprador',
        'cdc',
        'adn',
        'sitio',
        'status',
        'terceros',
        'prioridad',
        'patente',
        'archivo',
        'obs_costos',
        'obs_orm',
        'obs_bodega',
        'tipo',
        'descripcion'
    ];

    protected $casts = [
        'status' => 'boolean',
        'terceros' => 'boolean',
    ];
    public function detormRel(): HasMany
    {
        return $this->hasMany(DetOrm::class, 'orm', 'orm');
    }
    public function responsableRel(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsable');
    }

    public function compradorRel(): BelongsTo
    {
        return $this->belongsTo(User::class, 'comprador');
    }

    public function cdcRel(): BelongsTo
    {
        return $this->belongsTo(Cdc::class, 'cdc');
    }

    public function adnRel(): BelongsTo
    {
        return $this->belongsTo(Adn::class, 'adn');
    }

    public function sitioRel(): BelongsTo
    {
        return $this->belongsTo(Sitio::class, 'sitio');
    }

    public static function generarNumeroOrm()
    {
        $year = date('Y');

        $ultimo = self::orderBy('id', 'desc')->first();
        $ultimoId = $ultimo ? $ultimo->id + 1 : 1;

        return 'ORM' . $ultimoId . '-' . $year;
    }
}
