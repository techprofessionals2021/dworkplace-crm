<?php

namespace App\Models\Role\Relationship;

use App\Models\Permission\Permission;
use App\Models\Role\Role;
use App\Models\User;

trait RoleRelationship
{

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id');
    }

}
