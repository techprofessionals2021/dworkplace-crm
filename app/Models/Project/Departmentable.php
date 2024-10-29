<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Project\Relationship\ProjectDepartmentableRelationship;
use Illuminate\Database\Eloquent\Model;

class Departmentable extends Model
{
    use HasFactory, ProjectDepartmentableRelationship;

    protected $fillable = [
        'departmentable_type', 'departmentable_id', 'department_id'
    ];
}
