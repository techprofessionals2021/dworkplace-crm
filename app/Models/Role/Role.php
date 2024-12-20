<?php

namespace App\Models\Role;

use App\Models\Permission\Permission;
use App\Models\RolePermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role\Relationship\RoleRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory,RoleRelationship,SoftDeletes;

    protected $fillable = [
        'name'
    ];


    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }


}
