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
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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

        // Array to store attachment details
        $attachmentsData = [];

        // Check if there are attachments to be added
        if ($request->has('hasAttachment') && $request->hasAttachment) {
            $user = Auth::user();

            $attachmentsData = [];
            // Get all media items from the temp collection
            $attachments = $user->getMedia("temp-image-{$user->id}");

            // Attach each media to the thread and move to a new collection
            foreach ($attachments as $attachment) {
                $movedAttachment = $attachment->move($thread, 'thread-attachments');
                
                // Add URL and type to the attachments data array
                $attachmentsData[] = [
                    'url' => $movedAttachment->getUrl(),
                    'type' => $movedAttachment->mime_type,
                    'name' => !empty($movedAttachment->name) ? $movedAttachment->name : 'Unnamed',
                ];
                
                // Delete the attachment from the temporary collection after moving it
                $attachment->delete();
            }
            
        }

        broadcast(new ProjectThreadCreated($thread,$attachmentsData));

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

    public function uploadTempAttachment(Request $request)
    {
        // Validate the incoming file
        $request->validate([
            'file' => 'required|file|max:10240',
        ]);

        // Upload the attachment using ProjectThreadService
        $media = $this->projectThreadService->uploadAttachment($request->file('file'));

        // Prepare the response data
        $data = [
            'id' => $media->id,
        ];

        // Return success response with ResponseHelper
        return ResponseHelper::success($data, "Attachment Upload successfully", Response::HTTP_OK);
    }


    public function deleteTempAttachment($mediaId)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Find the media item by ID and ensure it belongs to the user
        $mediaItem = Media::where('id', $mediaId)
            ->where('model_type', get_class($user))
            ->where('model_id', $user->id)
            ->first();

        // Check if the media item exists and belongs to the authenticated user
        if (!$mediaItem) {
            return ResponseHelper::error('Attachment not found or not authorized to delete', Response::HTTP_NOT_FOUND);
        }

        // Delete the media item (removes both file and database record)
        $mediaItem->delete();

        // Return a success response
        return ResponseHelper::success(null, "Attachment deleted successfully", Response::HTTP_OK);
    }

    public function getUserTempAttachments()
    {
        $user = Auth::user();

        // Use the service to get user attachments
        $attachments = $this->projectThreadService->getUserAttachments($user);

        return ResponseHelper::success($attachments, 'User attachments retrieved successfully.', Response::HTTP_OK);
    }

}
