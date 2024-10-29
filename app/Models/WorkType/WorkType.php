<?php

namespace App\Models\WorkType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\WorkType\Relationship\WorkTypeRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkType extends Model
{
    
    use HasFactory ,WorkTypeRelationship ,SoftDeletes; 
    
    protected $fillable = [
        'department_id',
        'name',
        'type'
    ];


}
