<?php

namespace App\Models\Department;

use App\Models\Department\Relationship\DepartmentRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, DepartmentRelationship,SoftDeletes;

    protected $fillable = [
        'manager_id',
        'parent_department_id',
        'name',
        'description',
        'status_id',
        'type',
        'is_projectable',
        'slug',
    ];



}
