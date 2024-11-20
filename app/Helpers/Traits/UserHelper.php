<?php


namespace App\Helpers\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Notifications\FCMNotification;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

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

    public static function sendPushNotification($userID, $title, $body){
        $user = User::find($userID);

        if (!$user || empty($user->device_token)) {
            return response()->json([
                'status' => 'Error',
                'message' => 'User or device token not found',
            ]);
        }

        $message = CloudMessage::withTarget('token', $user->device_token)
            ->withNotification([
                'title' => $title,
                'body'  => $body,
            ]);

        try {
            // Log the request to debug multiple executions
            // \Log::info('Sending notification to: ' . $user->device_token);

            $messaging = Firebase::messaging();
            $response = $messaging->send($message);

            return response()->json([
                'status' => 'Notification sent successfully',
                'response' => $response,
            ]);

        } catch (\Kreait\Firebase\Exception\MessagingException $e) {
            return response()->json([
                'status' => 'Error sending notification',
                'error' => $e->getMessage(),
                'firebase_response' => $e->getResponseBody(),
            ]);
        }
    }
}
