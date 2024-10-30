<?php

namespace App\Services\ProjectAssignee;

use App\Models\Project\Project;
use App\Models\ProjectAssignee\ProjectAssignee;

class ProjectAssigneeService
{

    public function AssignProject($data)
    {
        $projectId = $data['project_id'];
        $newAssignees = $data['user_ids'];
        $projectType = $data['project_type'];

        if($projectType == 'project'){
            $project = Project::find($projectId);
            if($project){
                $assigneesWithPivotData = [];
                foreach ($newAssignees as $userId) {
                    $assigneesWithPivotData[$userId] = ['assigned_by' => auth()->id()];
                }
        
                // Sync with pivot data
                $project->assignees()->sync($assigneesWithPivotData);
            }
        }
        return;
        dd('done');

        // ProjectAssignee::where('projectable_id', $projectId)
        //     ->where('projectable_type', $projectType)
        //     ->whereNotIn('user_id', $newAssignees)
        //     ->delete();


        // foreach ($newAssignees as $userId) {
        //     ProjectAssignee::firstOrCreate([
        //         'projectable_id' => $projectId,
        //         'projectable_type' => $projectType,
        //         'user_id' => $userId,

        //     ]);
        // }


        return ProjectAssignee::where('projectable_id', $projectId)
            ->where('projectable_type', $projectType)
            ->get();
    }



}
