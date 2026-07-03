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
        'name',
        'email',
        'password',
        'status',
        'rol',
        'foto_perfil',
        'firma'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function rolRel(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'rol');
    }
    public function getPermissions()
    {
        if (!$this->RolRel) {
            return [];
        }

        $roles = config('roles.roles');
        $roleName = $this->RolRel->guard_name; // Obtener el nombre del rol desde la relación

        return $roles[$roleName]['permissions'] ?? [];
    }

    // public function hasPermission($permission)
    // {
    //     if (!$this->RolRel) {
    //         return false;
    //     }

    //     if ($this->RolRel->guard_name === 'super_admin') {
    //         return true;
    //     }

    //     $permissions = $this->getPermissions();
    //     return in_array($permission, $permissions) || in_array('*', $permissions);
    // }
    public function hasPermission($permission)
{
    $roleName = $this->getRoleNameAttribute();
    
    if ($roleName === 'super_admin') {
        return true;
    }
    
    $permissions = $this->getPermissions();
    
    // Verificar si el permiso exacto existe
    if (in_array($permission, $permissions)) {
        return true;
    }
    
    // Verificar si hay un wildcard (ej: bodegas.*)
    foreach ($permissions as $perm) {
        if (str_ends_with($perm, '.*')) {
            $prefix = rtrim($perm, '.*');
            if (str_starts_with($permission, $prefix)) {
                return true;
            }
        }
    }
    
    return false;
}

    public function hasRole($role)
    {
        return $this->RolRel && $this->RolRel->guard_name === $role;
    }

    public function hasAnyRole($roles)
    {
        return $this->RolRel && in_array($this->RolRel->guard_name, (array) $roles);
    }

    // Método para obtener el nombre del rol
    public function getRoleNameAttribute()
    {
        return $this->RolRel?->guard_name ?? 'Sin rol';
    }
}
