<?php

namespace App\Http\Controllers\Api\Project;

use App\Helpers\Response\ResponseHelper;
use App\Helpers\Traits\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\project\StoreRequest;
use App\Http\Resources\Project\ProjectResource;
use App\Http\Resources\project\ProjectDetailResource;
use App\Models\Project\Project;
use App\Models\Project\ProjectDetails;
use App\Models\Project\projectTransaction;
use App\Services\Project\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ProjectController extends Controller
{
    use UserHelper;

    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         if($this->hasPermission('view_all_projects')){

              $all_projects=$this->projectService->getAllProjects();

              $projectResouce = ProjectResource::collection($all_projects);

            return ResponseHelper::success($projectResouce, 'All Projects fetched successfully!',Response::HTTP_CREATED);

           }
          elseif($this->hasPermission('view_department_projects')){

          $depart_projects=$this->projectService->getDepartmentProjects();
          return ResponseHelper::success($depart_projects, 'Depart Projects fetched successfully!',Response::HTTP_CREATED);

          }else{

            if($this->hasPermission('view_assigned_projects')){
            $assignedProjects=$this->projectService->getAssignedProjects();
            return ResponseHelper::success($all_projects, 'Assigned Projects fetched successfully!',Response::HTTP_CREATED);
            }
         }
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $projectData = $request->all();
        $result = $this->projectService->createProject($projectData);

        $formatedResponse = new ProjectResource($result->getProject());

        return ResponseHelper::success($formatedResponse, 'Project created successfully!',Response::HTTP_CREATED);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $project = Project::with([
            'clients', 'sourceAccounts', 'financialDetails', 'departments',
            'salespersons', 'workTypes', 'media', 'projectTransactions',
            'projectAssignees', 'status'
        ])->findOrFail($id);

          $projectDetailResource =  new ProjectDetailResource($project);
          return ResponseHelper::success($projectDetailResource, "projectDetailResource Fetched Successfully", Response::HTTP_OK);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Retrive work types with options
     */
    public function getProjectWorkTypes()
    {
       $result = $this->projectService->getWorkTypesWithOptions();
       return ResponseHelper::success($result, 'WorkTypes Retrieved successfully!',Response::HTTP_OK);
    }

    /**
     * Retrive work types with options
     */
    public function getSalesPersons()
    {
       $result = $this->projectService->getSalesPersons();
       return ResponseHelper::success($result, 'WorkTypes Retrieved successfully!',Response::HTTP_OK);
    }

    public function uploadAttachments(Request $request,$id){
      $project = Project::find($id);
      if ($project) {
        foreach ($request->attachments as $attachment) {
            $project->addMedia($attachment)->toMediaCollection('attachments');
        }
        return ResponseHelper::success([],'Attachment Upload Succussfully');
      }

    }





}
