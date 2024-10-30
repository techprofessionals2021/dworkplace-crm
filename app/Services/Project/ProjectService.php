<?php

namespace App\Services\Project;

use App\Http\Resources\WorkType\WorkTypeCollection;
use App\Models\User;
use App\Models\Project\project;
use App\Models\WorkType\WorkType;
use App\Repositories\Project\ProjectRepository as ProjectProjectRepository;
use App\Repositories\ProjectRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Department\Department;

class ProjectService
{
    protected $projectRepository;

    public function __construct(ProjectProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function createProject(array $data)
    {

        return DB::transaction(function () use ($data) {
            // Create the project

            $project = $this->projectRepository->create($data['general'])
                ->addFinancialDetails($data['financial'])
                ->addDepartments($data['other']['departments'])
                ->addSalespersons($data['other']['salespersons'])
                ->addWorkTypes($data['work_types']);



            return $project;
        });
    }

    public function getWorkTypesWithOptions()
    {
        $workTypes = WorkType::with('department', 'options')->get();

        $groupedWorkTypes = $workTypes->groupBy(function ($item) {
            return $item->department->name;
        });

        // Return the grouped data via API Resource
        return WorkTypeCollection::make($groupedWorkTypes);
    }

    public function getSalesPersons()
    {

        $users = User::whereHas('departments', function ($q) {
            $q->where('name', 'Sales');
        })->get();

        return $users;
    }

    public function getAllProjects(){

        return Project::all();


    }


    public function getDepartmentProjects(){

     $userDepartment = Auth::user()->departments()->first();

     $depart_project=$userDepartment ? Project::whereHas('departments', fn($q) => $q->where('department_id', $userDepartment->id))
     ->get() : null;

      return $depart_project;
    }

    public function getAssignedProjects(){

        $user=Auth::user();
        $assigned_project=Project::wherehas('projectAssignee',fn($q)=> $q->where('user_id',$user->id))->get();
        return $assigned_project;

    }

    public function getProjectDetails($id)
    {
        $project = Project::with([
            'clients', 'sourceAccounts', 'financialDetails', 'departments',
            'salespersons', 'workTypes', 'media', 'projectTransactions',
            'status', 'projectUpdates', 'projectThreads',
            'creator'

        ])->find($id);


        return $project;
    }

    public function updateProjectStatus($data, $id){
        $project = $this->findProject($id);
        if(!$project){
            return null;
        }
        else{
            $project->status_id = $data["status_id"];
            $project->status_changed_at = now();
            $project->save();
            return $project;
        }
    }

    public function updateProject($projectData, $id)
    {
        $project = $this->projectRepository->find($id);
        if(!$project){
            return null;
        } else {
            return DB::transaction(function () use ($projectData, $id, $project) {
                $project = $this->projectRepository->update($projectData['general']) // Update general details
                    ->updateFinancialDetails($projectData['financial']) // Update financial details
                    ->updateDepartments($projectData['other']['departments']) // Update departments
                    ->updateSalespersons($projectData['other']['salespersons']) // Update salespersons
                    ->updateWorkTypes($projectData['work_types']); // Update work types

                return $project;
            });
        }
    }

    public function findProject($id)
    {
        return Project::find($id);
    }
}
