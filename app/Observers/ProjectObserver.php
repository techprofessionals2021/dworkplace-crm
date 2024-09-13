<?php

namespace App\Observers;

use App\Models\Project\Project;

class ProjectObserver
{

    public function creating(Project $project)
    {
        // Count the number of existing projects for the client
        $clientProjectCount = Project::where('client_id', $project->client_id)->count() + 1;

        // Generate the project_code based on project ID and client project count
        // Note: $project->id will be set after the project is saved, so you might need to set project_code after saving.
        // Using a placeholder for the ID in this case
        $project->project_code = 'PR-' . 'PLACEHOLDER' . '.' . $clientProjectCount;
    }

    /**
     * Handle the Project "created" event.
     */
    public function created(Project $project): void
    {
        // Update project_code after the project is saved to have the correct project_id
        $project->project_code = 'PR-' . $project->id . '.' . Project::where('client_id', $project->client_id)->count();
        $project->save(); // Save the updated project_code
    }

    /**
     * Handle the Project "updated" event.
     */
    public function updated(Project $project): void
    {
        //
    }

    /**
     * Handle the Project "deleted" event.
     */
    public function deleted(Project $project): void
    {
        //
    }

    /**
     * Handle the Project "restored" event.
     */
    public function restored(Project $project): void
    {
        //
    }

    /**
     * Handle the Project "force deleted" event.
     */
    public function forceDeleted(Project $project): void
    {
        //
    }
}
