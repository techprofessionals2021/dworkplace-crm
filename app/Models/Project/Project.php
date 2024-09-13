<?php

namespace App\Models\Project;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Project\Relationship\ProjectRelationship;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, ProjectRelationship;

    protected $fillable = [
        'creator_id', 'project_code', 'sales_code', 'title', 'description',
        'client_id', 'source_account_id', 'status_id', 'deadline',
    ];

}
