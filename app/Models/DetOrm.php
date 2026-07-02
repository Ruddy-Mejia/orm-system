<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;


class DetOrm extends Model
{
    use HasFactory;
    protected $table = 'tbl_det_orm';

    protected $fillable = [
        'orm',
        'cantidad',
        'detalle',
        'producto',
        'procesado',
        'ciudad',
        'f_estimada',
        'f_recepcion',
        'recepcion',
        'cantidad_recepcion',
        'bodega',
        'costo'
    ];

    protected $casts = [
        'procesado' => 'boolean',
        'f_estimada' => 'date',
        'f_recepcion' => 'date',
    ];

    public function ormRel()
    {
        return $this->belongsTo(Orm::class, 'orm', 'orm');
    }

    public function productoRel(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'producto');
    }

    public function ciudadRel(): BelongsTo
    {
        return $this->belongsTo(Ciudad::class, 'ciudad');
    }
    public function getOcRelAttribute()
    {
        $oc = Oc::where('det_orm', 'like', '%' . $this->id . '%')->first();
        return $oc;
    }
}
