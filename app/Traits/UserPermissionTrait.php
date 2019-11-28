<?php

namespace App\Traits;

use App\UserPermission;

trait UserPermissionTrait
{
    public function permissions()
    {
        return $this->morphToMany(
            UserPermission::class,
            'model',
            'user_permissionable',
            'model_id',
            'user_permission_id'
        );
    }

    public function getPermissions()
    {
        $permissions = $this->permissions;

        return $permissions->sort()->values();
    }

    public function hasPermissionTo($permission)
    {
        if(is_string($permission)) {
            $permission = UserPermission::where('code', '=', $permission)->first();
        }

        if(is_int($permission)) {
            $permission = UserPermission::find($permission);
        }

        if(!($permission instanceof UserPermission)) {
            return false;
        }

        return $this->permissions->contains('id', $permission->id);
    }

    public function hasAnyPermission(...$permissions)
    {
        if (is_array($permissions[0])) {
            $permissions = $permissions[0];
        }

        foreach($permissions as $permission) {
            if($this->hasPermissionTo($permission)) {
                return true;
            }
        }

        return false;
    }

    public function handlePermissionsIds($permissions)
    {
        $ids = [];
        $codes = [];

        foreach($permissions as $permission) {
            if(is_string($permission)) {
                if (ctype_digit($permission)) {
                    if(!in_array($permission, $ids)) {
                        $ids[] = $permission;
                    }
                }
                elseif(!in_array($permission, $codes)) {
                    $codes[] = $permission;
                }
            }
            elseif(is_int($permission)) {
                if(!in_array($permission, $ids)) {
                    $ids[] = $permission;
                }
            }
            elseif($permission instanceof UserPermission) {
                if(!in_array($permission->id, $ids)) {
                    $ids[] = $permission->id;
                }
            }
        }

        if(!empty($codes)) {
            $up = UserPermission::whereIn('code', $codes)->get();
            foreach($up as $permission) {
                if(!in_array($permission->id, $ids)) {
                    $ids[] = $permission->id;
                }
            }
        }

        return $ids;
    }

    public function givePermissionTo(...$permissions)
    {
        if (is_array($permissions[0])) {
            $permissions = $permissions[0];
        }

        $ids = $this->handlePermissionsIds($permissions);

        $this->permissions()->sync($ids, false);
    }

    public function syncPermissions(...$permissions)
    {
        if (is_array($permissions[0])) {
            $permissions = $permissions[0];
        }

        $this->permissions()->detach();
        $this->givePermissionTo($permissions);
    }

    public function revokePermissionsTo(...$permissions)
    {
        if (is_array($permissions[0])) {
            $permissions = $permissions[0];
        }

        $ids = $this->handlePermissionsIds($permissions);

        $this->permissions()->detach($ids);
    }
}
