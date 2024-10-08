<?php

namespace App\Services\ProjectUpdate;

use App\Models\ProjectUpdate\ProjectUpdate;
use App\Models\Project\Project;
use App\Services\Project\ProjectService;

class ProjectUpdateService
{
    protected $projectService;

    public function __construct(ProjectService $projectService){
        $this->projectService = $projectService;
    }

    public function createProjectUpdate($data)
    {
        $data = $this->setProjectableType($data);
        return ProjectUpdate::create($data);
    }

    public function updateProjectUpdate($data, $id){
        $projectUpdate = $this->findProjectUpdate($id);
        $data = $this->setProjectableType($data);
        if(!$projectUpdate){
            return null;
        }
        $projectUpdate->update($data);

        return $projectUpdate;

    }

    public function deleteProjectUpdate($id){
        $projectUpdate = $this->findProjectUpdate($id);
        if(!$projectUpdate){
            return null;
        }
        return $projectUpdate->delete();
    }

    public function findProjectUpdate($id){
        return ProjectUpdate::find($id);
    }

    public function setProjectableType($data){
        if($data['projectable_type'] == 'project'){
            $data['projectable_type'] = Project::class;
        } else {

        }
        return $data;
    }
}
