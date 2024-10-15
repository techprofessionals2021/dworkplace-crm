<?php

namespace App\Models\ProjectAssignee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAssignee extends Model
{
    use HasFactory;
    protected $fillable=[

        'user_id',
        'projectable_id',
        'projectable_type',
        'assigned_by'
    ];
    public function projectable(): MorphTo
    {
        return $this->morphTo();
    }


}
