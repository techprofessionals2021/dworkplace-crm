<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project\Departmentable;

class ProjectWorkTypeValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_department_id', 'work_type_id', 'option_id', 'value', 'type',
    ];

    public function departmentable()
    {
        return $this->belongsTo(Departmentable::class, 'project_department_id');
    }
}
