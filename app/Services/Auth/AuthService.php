<?php


namespace App\Services\Auth;

use App\Helpers\Traits\UserHelper;
use App\Models\User;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthService
{
    use UserHelper;
    public function register($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'contact' => $data['contact'],
            'password' => Hash::make($data['password']),
            'status_id' => 1, // Assuming a default status
        ]);

        if (isset($data['role_ids']) && is_array($data['role_ids'])) {
            $user->roles()->attach($data['role_ids']);
        }

        if (isset($data['department_ids']) && is_array($data['department_ids'])) {
            $user->departments()->attach($data['department_ids']);
        }

        return $user;
    }

    public function login($credentials)
    {


        $user = User::where('email', $credentials['email'])->with(['roles'])->first();
        // dd('asd');
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return null;
        }

        // dd($user->getDepartmentPermissions()->pluck('name'));
        $token = $user->createToken('auth_token')->plainTextToken;
        $roles = $user->roles->pluck('name');

        $permissions = $user->getPermissions()->pluck('name');
        $departPermissions = $user->getDepartmentPermissions()->pluck('name');
        $allPermissions =  $permissions->merge($departPermissions);

        return [
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $roles,
                'permissions' => $allPermissions,
            ],
        ];


     }

     public function sendResetLink(array $credentials)
     {
         // Validate user email
         $user = User::where('email', $credentials['email'])->firstOrFail();
     
         // Generate reset token
         $token = Password::createToken($user);
     
         // Send the custom reset email
         $user->notify(new CustomResetPasswordNotification($token));
     
         return Password::RESET_LINK_SENT;
     }


    public function resetPassword($data)
    {
        $status = Password::reset(
            $data,
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        return $status;
    }
}
