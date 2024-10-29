<?php

namespace App\Services\ProjectAssignee;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectAssignee\ProjectAssignee;

class ProjectAssigneeService
{

    public function AssignProject($data)
    {

        $projectId = $data['project_id'];
        $newAssignees = $data['user_ids'];
        $projectType = $data['projectable_type'];
        $assigned_by=Auth::user();



        ProjectAssignee::where('projectable_id', $projectId)
            ->where('projectable_type', $projectType)
            ->whereNotIn('user_id', $newAssignees)
            ->delete();


        foreach ($newAssignees as $userId) {
            ProjectAssignee::firstOrCreate([
                'projectable_id' => $projectId,
                'projectable_type' => $projectType,
                'user_id' => $userId,
                'assigned_by'=>$assigned_by->id

            ]);
        }


        return ProjectAssignee::where('projectable_id', $projectId)
            ->where('projectable_type', $projectType)
            ->get();
    }



}
