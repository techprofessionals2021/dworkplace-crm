<?php

namespace App\Repositories\Project;

use App\Models\Project\Project;
use App\Models\Project\ProjectWorkType;
use App\Models\Project\ProjectWorkTypeValue;

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
        return $this;
    }

    public function addSalespersons(array $salespersons): self
    {
        $this->project->salespersons()->attach($salespersons);
        $this->project->load('salespersons');
        return $this;
    }

    public function addWorkTypes(array $workTypes): self
    {
        // Prepare the work types array for bulk insert
        $workTypesArray = array_map(function ($workType) {
            return [
                'workable_id' => $this->project->id,  // ID of the project or direct project
                'workable_type' => Project::class,  // Model name for polymorphic relation
                'work_type_id' => $workType['work_type_id'],
                'option_id' => $workType['work_type_option_id'] ?? null,
                'value' => $workType['value'] ?? null,
                'type' => isset($workType['work_type_option_id']) ? 'option' : 'value',
                'created_at' => now(), // Add timestamp for bulk insert
                'updated_at' => now(),
            ];
        }, $workTypes);

        ProjectWorkType::insert($workTypesArray);
        
        // Load the work type values into the project instance
        $this->project->load('workTypes');
        return $this;
    }

    protected function getDepartmentableId($departmentId)
    {
        // Access the already-loaded departments using $this->project
        $department = $this->project->departments->firstWhere('id', $departmentId);
        return $department ? $department->pivot->id : null; // Get the pivot ID (departmentable_id)
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

    public function getProject(): Project
    {
        return $this->project;
    }
}
