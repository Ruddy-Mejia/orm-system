<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sitio extends Model
{
    use HasFactory;
    protected $table = 'tbl_sitios';
    
    protected $fillable = ['descripcion', 'status'];
    
    public function orms(): HasMany
    {
        return $this->hasMany(Orm::class, 'sitio');
    }
}