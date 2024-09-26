<?php

namespace App\Models\Project;

use App\Models\WorkType\WorkType;
use App\Models\WorkTypeOption\WorkTypeOption;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectWorkType extends Model
{
    use HasFactory;

    protected $fillable = [
        'workable_id', 'workable_type', 'work_type_id', 'option_id', 'value', 'type'
    ];

    // Define the inverse polymorphic relation
    public function workable()
    {
        return $this->morphTo();
    }

    // Relationship with WorkType
    public function workType()
    {
        return $this->belongsTo(WorkType::class);
    }

    // Relationship with WorkTypeOption (if using options)
    public function option()
    {
        return $this->belongsTo(WorkTypeOption::class);
    }

}
