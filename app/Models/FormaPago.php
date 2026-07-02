<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPago extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_forma_pago';
    
    protected $fillable = ['descripcion', 'status', 'autopago'];
    
    protected $casts = [
        'status' => 'boolean',
        'autopago' => 'boolean',
    ];
    
    public function ocs()
    {
        return $this->hasMany(Oc::class, 'forma_pago');
    }
}