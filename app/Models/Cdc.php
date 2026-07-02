<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cdc extends Model
{
    use HasFactory;
    protected $table = 'tbl_cdc';
    
    protected $fillable = ['cdc', 'descripcion', 'banco', 'tipo'];
    
    public function orms(): HasMany
    {
        return $this->hasMany(Orm::class, 'cdc');
    }
}