<?php

namespace App\Services\Project;

use App\Http\Resources\WorkType\WorkTypeCollection;
use App\Models\User;
use App\Models\WorkType\WorkType;
use App\Repositories\Project\ProjectRepository as ProjectProjectRepository;
use App\Repositories\ProjectRepository;
use Illuminate\Support\Facades\DB;

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
                ->addSalespersons($data['other']['salespersons']);

            // if (isset($data['work_types'])) {
            //     $this->projectRepository->addWorkTypes($data['work_types']);
            // }

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
}
