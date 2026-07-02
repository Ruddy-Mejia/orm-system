<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory;
    protected $table = 'tbl_users';
    
    protected $fillable = [
        'name', 'email', 'password', 'status', 'rol', 'foto_perfil', 'firma'
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function rolRel(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'rol');
    }
    
    // public function ormsAsResponsable()
    // {
    //     return $this->hasMany(Orm::class, 'responsable');
    // }
    
    // public function ormsAsComprador()
    // {
    //     return $this->hasMany(Orm::class, 'comprador');
    // }
}