<?php

namespace App\Models\ProjectAssignee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectAssignee\Relationship\ProjectAssigneeRelationship;

class ProjectAssignee extends Model
{
    use HasFactory, ProjectAssigneeRelationship;
    protected $fillable=[

        'user_id',
        'projectable_id',
        'projectable_type',
        'assigned_by'
    ];

}
