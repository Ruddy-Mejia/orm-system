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
        if (!$this->rolRel) {
            return [];
        }

        $roles = config('roles.roles');
        $roleName = $this->rolRel->guard_name;

        return $roles[$roleName]['permissions'] ?? [];
    }

    public function hasPermission($permission)
    {
        $roleName = $this->getRoleNameAttribute();

        if ($roleName === 'admin') {
            return true;
        }

        $permissions = $this->getPermissions();

        if (in_array($permission, $permissions)) {
            return true;
        }

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
        return $this->rolRel && $this->rolRel->guard_name === $role;
    }

    public function hasAnyRole($roles)
    {
        return $this->rolRel && in_array($this->rolRel->guard_name, (array) $roles);
    }

    public function getRoleNameAttribute()
    {
        return $this->rolRel?->guard_name ?? 'Sin rol';
    }
}
