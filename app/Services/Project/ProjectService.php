<?php

namespace App\Services\Project;

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
        // dd($data);
        return DB::transaction(function () use ($data) {
            $project = $this->projectRepository->create($data['general'])
                ->addFinancialDetails($data['financial'])
                ->addDepartments($data['other']['departments']);
                // ->addSalespersons($data['other']['salespersons']);

            if (isset($data['work_types'])) {
                $this->projectRepository->addWorkTypes($data['work_types']);
            }
dd($project);
            return $project;
        });
    }
}
