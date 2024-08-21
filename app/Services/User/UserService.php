<?php

namespace App\Services\User;

use App\Models\User;

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
}