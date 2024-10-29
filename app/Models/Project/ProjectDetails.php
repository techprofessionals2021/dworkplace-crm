<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Project\Relationship\ProjectDetailsRelationship;
use Illuminate\Database\Eloquent\Model;

class ProjectDetails extends Model
{
    use HasFactory, ProjectDetailsRelationship;

    protected $fillable = [
        'project_id', 'currency_id', 'total_amount', 'upfront_amount',
        'remaining_amount', 'priority', 'payment_type', 'is_locked',
    ];


}
