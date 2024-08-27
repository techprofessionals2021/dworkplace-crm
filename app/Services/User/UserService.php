<?php

namespace App\Services\User;

use App\Models\User;
use Hash;

class UserService
{
    /**
     * Get all users with their roles and permissions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllUsers()
    {
        return User::get();
    }


    public function updateUser($userId, $data)
    {
        $user = User::findOrFail($userId);

        $user->update([
            'name' => $data['name'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
            'contact' => $data['contact'] ?? $user->contact,
            'password' => isset($data['password']) ? Hash::make($data['password']) : $user->password,
            'status_id' => $data['status_id'] ?? $user->status_id,
        ]);

        if (isset($data['role_ids']) && is_array($data['role_ids'])) {
            $user->roles()->sync($data['role_ids']);
        }

        if (isset($data['department_ids']) && is_array($data['department_ids'])) {
            $user->departments()->sync($data['department_ids']);
        }

        return $user;
    }


    public function updateUserStatus($userId, $statusId)
    {
        // Find the user by ID
        $user = User::findOrFail($userId);

        // Update the status_id
        $user->status_id = $statusId;
        $user->save();

        return $user;
    }
}