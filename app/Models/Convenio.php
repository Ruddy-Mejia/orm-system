<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_convenio';
    
    protected $fillable = ['convenio', 'dia', 'status'];
    
    protected $casts = [
        'status' => 'boolean',
    ];
    
    public function ocs()
    {
        return $this->hasMany(Oc::class, 'convenio');
    }
}