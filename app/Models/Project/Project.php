<?php

namespace App\Models\Project;

use App\Models\Department\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'creator_id', 'project_code', 'sales_code', 'title', 'description',
        'client_id', 'source_account_id', 'status_id', 'deadline',
    ];

    public function financialDetails()
    {
        return $this->hasOne(ProjectDetails::class);
    }

    public function departments()
    {
        return $this->morphToMany(Department::class,'projectable', 'project_departments', 'department_id', 'projectable_id');
    }
}
