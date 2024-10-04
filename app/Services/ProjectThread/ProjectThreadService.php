<?php

namespace App\Services\ProjectThread;

use App\Models\Project\Project;
use App\Models\Project\ProjectThread;

class ProjectThreadService
{
    public function createThreadMessage(array $data)
    {
        if($data["threadable_type"] == "project"){
            $data["threadable_type"] = Project::class;
            return ProjectThread::create($data);
        } else if($data["threadable_type"] == "project-update")
        {

        } else {

        }
    }
}
