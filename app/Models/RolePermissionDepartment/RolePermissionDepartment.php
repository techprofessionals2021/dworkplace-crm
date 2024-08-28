<?php

namespace App\Models\RolePermissionDepartment;

use App\Models\RolePermissionDepartment\Relationship\RolePermissionDepartmentRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermissionDepartment extends Model
{
    use HasFactory,RolePermissionDepartmentRelationship;
    protected $fillable = ['role_id', 'permission_id', 'department_id'];

}
