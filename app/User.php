<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Traits\UserPermissionTrait;

use App\UserRole;

class User extends Authenticatable
{
    use Notifiable;
    use UserPermissionTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot() {
        parent::boot();

        static::deleting(function($item) {
             $item->permissions()->detach();
        });
    }

    public function roles()
    {
        return $this->belongsToMany(UserRole::class, 'user_role_user', 'user_id', 'role_id');
    }

    public function hasRoles($roles) {
        if(is_array($roles)) {
            return null !== $this->roles()->whereIn('code', $roles)->first();
        }

        return null !== $this->roles()->where('code', $roles)->first();
    }

    /* permissions extended */
    public function hasAnyPermissionEx(...$permissions)
    {
        $bUserPerm = $this->hasAnyPermission($permissions);
        if($bUserPerm) {
            return true;
        }

        foreach($this->roles as $role) {
            if($role->hasAnyPermission($permissions)) {
                return true;
            }
        }

        return false;
    }
}
