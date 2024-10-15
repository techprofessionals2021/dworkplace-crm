<?php

namespace App\Services\ProjectAssignee;
use App\Models\ProjectAssignee\ProjectAssignee;

class ProjectAssigneeService
{

    public function AssignProject($data){
        $project_assignee = ProjectAssignee::create($data);
        return $project_assignee;
    }
}
