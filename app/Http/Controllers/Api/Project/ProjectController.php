<?php

namespace App\Http\Controllers\Api\Project;

use App\Helpers\Response\ResponseHelper;
use App\Helpers\Traits\UserHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\project\StoreRequest;
use App\Http\Requests\project\ThreadRequest;
use App\Http\Resources\Project\ProjectResource;
use App\Http\Resources\Project\ProjectDetailResource;
use App\Models\Project\Project;
use App\Models\Project\ProjectDetails;
use App\Services\Project\ProjectService;
use App\Services\ProjectThread\ProjectThreadService;
use App\Events\ProjectThreadCreated;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ProjectController extends Controller
{
    use UserHelper;

    protected $projectService;
    protected $projectThreadService;

    public function __construct(ProjectService $projectService, ProjectThreadService $projectThreadService)
    {
        $this->projectService = $projectService;
        $this->projectThreadService = $projectThreadService;
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
        $project = $this->projectService->getProjectDetails($id);
        if($project){
            $projectDetailResource =  new ProjectDetailResource($project);
            // dd($projectDetailResource);
            return ResponseHelper::success($projectDetailResource, "projectDetailResource Fetched Successfully", Response::HTTP_OK);
        } else {
            return ResponseHelper::error('Project Not Found', Response::HTTP_NOT_FOUND);
        }
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
        $projectData = $request->all();
        $result = $this->projectService->updateProject($projectData, $id);
        if(!$result){
            return ResponseHelper::error('Project Not Found', Response::HTTP_NOT_FOUND);
        } else {
            $formatedResponse = new ProjectResource($result->getProject());
            return ResponseHelper::success($formatedResponse, 'Project Updated successfully!',Response::HTTP_OK);
        }
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


    public function getProjectDetail($id)
    {
        $project = Project::with([
            'clients', 'sourceAccounts', 'financialDetails', 'departments',
            'salespersons', 'workTypes', 'media', 'projectTransactions',
            'status'
        ])->findOrFail($id);

        $projectDetailResource =  new ProjectDetailResource($project);
        return ResponseHelper::success($projectDetailResource, "projectDetailResource Fetched Successfully", Response::HTTP_OK);

    }

    public function createThread(ThreadRequest $request)
    {
        $threadData = $request->validated();
        $thread = $this->projectThreadService->createThreadMessage($threadData);
        broadcast(new ProjectThreadCreated($thread))->toOthers();

        return ResponseHelper::success($thread, "Project Thread Created successfully", Response::HTTP_OK);
    }

    public function updateStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status_id' => 'required|exists:statuses,id'
        ]);
        $data = $validator->validated();
        $projectStatus = $this->projectService->updateProjectStatus($data, $id);
        if(!$projectStatus){
            return ResponseHelper::error('Project Not Found', Response::HTTP_NOT_FOUND);
        } else {
            return ResponseHelper::success($projectStatus, "Project Status updated successfully", Response::HTTP_OK);
        }
    }

    public function updateAttachment(Request $request,$id){
        $project = Project::find($id);

        if ($project) {
            // Step 1: Clear existing attachments
            // $project->clearMediaCollection('attachments');

            // Step 2: Add new attachments
            foreach ($request->attachments as $attachment) {
                $project->addMedia($attachment)->toMediaCollection('attachments');
            }

            // Step 3: Return a successful response
            return ResponseHelper::success([], 'Attachments updated successfully');
        }

        return ResponseHelper::error('Project not found', 404);
    }

}
