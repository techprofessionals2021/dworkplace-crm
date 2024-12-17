<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project\Relationship\ProjectThreadRelationship;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ProjectThread extends Model implements HasMedia
{
    use HasFactory, ProjectThreadRelationship,InteractsWithMedia;

    protected $fillable = [
        'user_id', 'parent_id', 'threadable_type', 'threadable_id', 'message'
    ];
}
