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

    public function updateUserPassword($data){
        $user = User::find($data['user_id']);

        $user->password = Hash::make($data['password']);
        $user->save();

        return $user;
    }

    public function getUserDetails($id)
    {
        // Find the user by ID or throw a 404 error if not found
        return User::findOrFail($id);
    }

    public function updateUserProfile($id, array $data)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Update other attributes
        $user->fill($data);

        // Update the password only if it is provided
        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }

        // Save the updated user profile
        $user->save();

        return $user;
    }


    public function updateProfileImage(User $user, $image)
    {
        // Clear old media (optional)
        $user->clearMediaCollection('profile_images');

        // Add new media
        $user->addMedia($image)
             ->preservingOriginal()
             ->toMediaCollection('profile_images');

        return $user;
    }
}
