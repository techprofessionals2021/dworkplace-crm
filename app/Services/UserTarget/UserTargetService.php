<?php

namespace App\Services\UserTarget;

use App\Models\UserTarget\UserTarget;

class UserTargetService
{
    public function getAllUserTargets()
    {
        return UserTarget::all();
    }
    public function createUserTarget($data)
    {
        $userTarget = $this->findUserTargetbyUserId($data["user_id"]);
        if($userTarget){
            $userTarget->end_date = $data["start_date"];
            $userTarget->save();
        }
        return UserTarget::create($data);
    }
    public function getUserTargetById($id)
    {
        return UserTarget::find($id);
    }
    public function updateUserTarget($id, $data)
    {
        $userTarget = $this->getUserTargetById($id);
        if(!$userTarget){
            return null;
        } else {
            $userTarget->update($data);
            return $userTarget;
        }
    }
    public function deleteUserTarget($id)
    {
        $userTarget = $this->getUserTargetById($id);
        if(!$userTarget){
            return null;
        } else {
            return $userTarget->delete();
        }
    }
    public function findUserTargetbyUserId($userId)
    {
        $userTarget = UserTarget::where('user_id', $userId)->where('end_date',null)->first();
        if(!$userTarget){
            return null;
        } else {
            return $userTarget;
        }
    }
}
