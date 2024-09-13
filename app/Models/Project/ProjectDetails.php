<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'currency_id', 'total_amount', 'upfront_amount',
        'remaining_amount', 'priority', 'payment_type', 'is_locked',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
