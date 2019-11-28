<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\UserPermissionTrait;

use App\User;

class UserRole extends Model
{
    use UserPermissionTrait;

    protected $fillable = ['name', 'code'];

    public static function boot() {
        parent::boot();

        static::deleting(function($item) {
             $item->permissions()->detach();
        });
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
