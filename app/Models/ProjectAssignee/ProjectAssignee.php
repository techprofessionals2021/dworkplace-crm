<?php

namespace App\Models\ProjectAssignee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Access roles through the user
    public function roles()
    {
        return $this->user->roles();
    }

}
