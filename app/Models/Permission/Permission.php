<?php

namespace App\Models\Permission;

use App\Models\Permission\Relationship\PermissionRelationship;
use App\Models\Role\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory,PermissionRelationship;

}
