<?php

namespace App\Models\ProjectUpdate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectUpdate\Relationship\ProjectUpdateRelationship;

class ProjectUpdate extends Model
{
    use HasFactory, ProjectUpdateRelationship;

    protected $fillable = [
        'projectable_type', 'projectable_id', 'user_id', 'status_id', 'deadline', 'message'
    ];
}
