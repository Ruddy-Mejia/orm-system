<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Adn extends Model
{
    use HasFactory;
    protected $table = 'tbl_adn';
    
    protected $fillable = ['descripcion', 'tipo'];
    
    public function orms(): HasMany
    {
        return $this->hasMany(Orm::class, 'adn');
    }
}