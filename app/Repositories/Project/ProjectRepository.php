<?php

namespace App\Repositories\Project;

use App\Models\Project\Project;

class ProjectRepository
{
    protected $project;

    public function create(array $data): self
    {
        $this->project = Project::create($data);
        return $this;
    }

    public function addFinancialDetails(array $data): self
    {
        $this->project->financialDetails()->create($data);
    
        return $this;
    }
    //  public function addAttachments(array $attachments):self
    //  {
    //     $this->project->addMedia($attachments)->toMediaCollection('attachments');    
    //   }
    public function addAttachments(array $attachments): self
    {
      
        foreach ($attachments as $attachment) {
            $this->project->addMedia($attachment)->toMediaCollection('attachments');    
        }
        return $this;
    }

    

    public function addDepartments(array $departments): self
    {
        // foreach ($departments as $department) {
        //     ProjectDepartment::create([
        //         'projectable_type' => 'App\\Models\\Project',
        //         'projectable_id' => $this->project->id,
        //         'department_id' => $department['department_id'],
        //     ]);
        // }

        $this->project->departments()->sync($departments);
        $this->project->load('departments');

        // dd($pivotRecords = $this->project->departments->map(function ($department) {
        //     return [
        //         'department_id' => $department->id,
        //         'department_name' => $department->name,
        //         'pivot_id' => $department->pivot->id, // Access the pivot ID if it's set up
        //     ];
        // }));
        dd($this);
        return $this;
    }

    public function addSalespersons(array $salespersons): self
    {
        foreach ($salespersons as $salesperson) {
            $this->project->salespersons()->create([
                'user_id' => $salesperson['user_id'],
            ]);
        }
        return $this;
    }

    public function addWorkTypes(array $workTypes): self
    {
        // foreach ($workTypes as $workType) {
        //     ProjectWorkTypeValue::create([
        //         'project_department_id' => $this->getProjectDepartmentId($workType['department_id']),
        //         'work_type_id' => $workType['work_type_id'],
        //         'option_id' => $workType['type'] === 'option' ? $workType['work_type_option_id'] : null,
        //         'value' => $workType['type'] === 'value' ? $workType['value'] : null,
        //         'type' => $workType['type'],
        //     ]);
        // }
        // return $this;


    }

    public function loadRelations(): Project
    {
        return $this->project->load(['financialDetails', 'departments', 'salespersons']);
    }

    protected function getProjectDepartmentId($departmentId)
    {
        return ProjectDepartment::where('projectable_id', $this->project->id)
            ->where('department_id', $departmentId)
            ->first()->id;
    }
}
