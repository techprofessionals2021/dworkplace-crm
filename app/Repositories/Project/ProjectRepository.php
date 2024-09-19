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
    //  public function addAttachments(array $data):self
    //  {
        
    //     $this->project->addMedia()->toMediaCollection('images');

    //  }

    public function addDepartments(array $departments): self
    {
        // foreach ($departments as $department) {
        //     ProjectDepartment::create([
        //         'projectable_type' => 'App\\Models\\Project',
        //         'projectable_id' => $this->project->id,
        //         'department_id' => $department['department_id'],
        //     ]);
        // }
        $this->project->departments()->attach($departments);
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
        foreach ($workTypes as $workType) {
            ProjectWorkTypeValue::create([
                'project_department_id' => $this->getProjectDepartmentId($workType['department_id']),
                'work_type_id' => $workType['work_type_id'],
                'option_id' => $workType['type'] === 'option' ? $workType['work_type_option_id'] : null,
                'value' => $workType['type'] === 'value' ? $workType['value'] : null,
                'type' => $workType['type'],
            ]);
        }
        return $this;
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
