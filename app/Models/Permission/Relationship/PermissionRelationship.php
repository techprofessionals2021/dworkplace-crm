<?php

namespace App\Models\Permission\Relationship;

use App\Models\Role\Role;
use App\Models\User;

trait PermissionRelationship
{

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions', 'permission_id', 'role_id');
    }

}
