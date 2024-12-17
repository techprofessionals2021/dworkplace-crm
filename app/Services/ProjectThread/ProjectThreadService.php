<?php

namespace App\Services\ProjectThread;

use App\Models\Project\Project;
use App\Models\Project\ProjectThread;
use App\Models\ProjectUpdate\ProjectUpdate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProjectThreadService
{
    public function createThreadMessage(array $data)
    {
        if($data["threadable_type"] == "project"){

            $data["threadable_type"] = Project::class;
            return ProjectThread::create($data);

        } else if($data["threadable_type"] == "project-update")
        {

            $data["threadable_type"] = ProjectUpdate::class;
            return ProjectThread::create($data);

        } else {

        }
    }

    public function uploadAttachment($file)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        // Define the collection name dynamically
        $collectionName = "temp-image-{$user->id}";

        // Add media to the user's collection
        $media = $user->addMedia($file)->toMediaCollection($collectionName);

        // Return the media URL
        return $media;
    }


    public function getUserAttachments(User $user)
    {
        // Get all media files from the user's "temp-image-{auth-id}" collection
        return $user->getMedia("temp-image-{$user->id}")->map(function ($media) {
            return [
                'id' => $media->id,
                'name' => $media->file_name,
                'url' => $media->getUrl(),
                'type' => $media->mime_type,
                'size' => $media->size,
                'created_at' => $media->created_at,
            ];
        });
    }
}
