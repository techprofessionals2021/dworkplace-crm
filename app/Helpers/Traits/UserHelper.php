<?php


namespace App\Helpers\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

trait UserHelper
{

    public function getCurrentUserPermissions()
    {
        $user = Auth::user();
        // Use cache to store and retrieve permissions for this user
        return Cache::remember('user_permissions_' . $user->id, 60 * 60, function () use ($user) {
            $permissions = $user->getPermissions()->pluck('name');
            $departPermissions = $user->getDepartmentPermissions()->pluck('name');
            return $permissions->merge($departPermissions);
        });
    }

    public function hasPermission(string $permission): bool
    {
        // Get the cached permissions
        $allPermissions = $this->getCurrentUserPermissions();

        // Check if the specific permission exists in the cached permissions
        return $allPermissions->contains($permission);
    }
}
