<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ciudad extends Model
{
    use HasFactory;
    protected $table = 'tbl_ciudades';
    
    protected $fillable = ['nombre'];
    
    public function detallesOrm(): HasMany
    {
        return $this->hasMany(DetOrm::class, 'ciudad');
    }
}