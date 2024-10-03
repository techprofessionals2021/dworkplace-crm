<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project\Relationship\ProjectThreadRelationship;

class ProjectThread extends Model
{
    use HasFactory, ProjectThreadRelationship;

    protected $fillable = [
        'user_id', 'parent_id', 'threadable_type', 'threadable_id', 'message'
    ];
}
