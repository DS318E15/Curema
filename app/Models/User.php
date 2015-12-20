<?php

namespace Curema\Models;

use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, HasRoleAndPermissionContract
{
    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes, HasRoleAndPermission;

    protected $guarded = ['password_confirmation', 'role_id'];

    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['deleted_at'];

    public function changes()
    {
        return $this->hasMany('Curema\Models\App\Change')->orderBy('updated_at', 'DESC');
    }

    public function roles()
    {
        return $this->belongsToMany('Bican\Roles\Models\Role');
    }
}
