<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'manager_id',
        'parent_department_id',
        'name',
        'description',
        'status_id',
        'type',
        'is_projectable',
    ];

}
