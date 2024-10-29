<?php

namespace App\Models\Project\Relationship;
use App\Models\Department\Department;
use App\Models\Project\Departmentable;
use App\Models\Project\ProjectDetails;
use App\Models\Project\ProjectThread;
use App\Models\Project\ProjectWorkType;
use App\Models\ProjectUpdate\ProjectUpdate;
use App\Models\ProjectAssignee\ProjectAssignee;
use App\Models\Project\ProjectWorkTypeValue;
use App\Models\User;
use App\Models\SourceAccount\SourceAccount;
use App\Models\Client\Client;
use App\Models\Status\Status;
use App\Models\Project\ProjectTransaction;
use Illuminate\Database\Eloquent\Relations\MorphMany;


trait ProjectRelationship
{
    // Define your relationships here
    public function financialDetails()
    {
        return $this->hasOne(ProjectDetails::class);
    }

    public function departments()
    {
        return $this->morphToMany(Department::class,'departmentable')->withPivot('id');
    }

    public function workTypeValues()
    {
        return $this->hasManyThrough(
            ProjectWorkTypeValue::class,
            Departmentable::class,
            'departmentable_id', // Foreign key on departmentable table...
            'project_department_id', // Foreign key on ProjectWorkTypeValue table...
            'id', // Local key on projects table...
            'id' // Local key on departmentable table...
        )->where('departmentables.departmentable_type', Project::class);
    }

    public function salespersons()
    {
        return $this->belongsToMany(User::class, 'project_salespersons');
    }

    public function workTypes()
    {
        return $this->morphMany(ProjectWorkType::class, 'workable');
    }

    public function projectTransactions(): MorphMany
    {
        return $this->morphMany(ProjectTransaction::class, 'projectable');
    }
    public function projectAssignees():MorphMany
    {
        return $this->morphMany(ProjectAssignee::class,'projectable');
    }
    public function sourceAccounts()
    {
       return $this->belongsTo(SourceAccount::class ,'source_account_id'); // Assuming this is the correct relationship
    }
    public function clients(){
      return $this->belongsTo(Client::class ,'client_id');
    }
    public function status(){
        return $this->belongsTo(Status::class,'status_id');
    }

    public function projectThreads(){
        return $this->morphMany(ProjectThread::class, 'threadable');
    }

    public function projectUpdates(){
        return $this->morphMany(ProjectUpdate::class, 'projectable');
    }
    
     public function creator()
     {
         return $this->belongsTo(User::class, 'creator_id');
     }
}
