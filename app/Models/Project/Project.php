<?php

namespace App\Models\Project;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Project\Relationship\ProjectRelationship;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use HasFactory, ProjectRelationship, InteractsWithMedia, LogsActivity;

    protected $fillable = [
        'creator_id', 'project_code', 'sales_code', 'title', 'description',
        'client_id', 'source_account_id', 'status_id', 'deadline',
    ];

    protected $casts = [
        'status_changed_at' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'description', 'status_id', 'deadline'])
            ->logOnlyDirty()
            ->useLogName('project')
            ->setDescriptionForEvent(fn(string $eventName) => "Project {$eventName} by " . auth()->user()->name);
    }

}
