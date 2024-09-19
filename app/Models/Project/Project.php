<?php

namespace App\Models\Project;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Project\Relationship\ProjectRelationship;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use HasFactory, ProjectRelationship, InteractsWithMedia;

    protected $fillable = [
        'creator_id', 'project_code', 'sales_code', 'title', 'description',
        'client_id', 'source_account_id', 'status_id', 'deadline',
    ];

}
