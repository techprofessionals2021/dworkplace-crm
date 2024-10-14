<?php

namespace App\Http\Controllers\Api\Auth;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Http\JsonResponse;
use App\Helpers\Response\ResponseHelper;
use App\Models\Project\Project;
use App\Notifications\User\UserCreatedNotification;
use App\Services\Auth\AuthService;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->authService->register($request->validated());
        $token = $user->createToken('auth_token')->plainTextToken;

        $users = auth()->user();

        // $project = Project::find(1);
        
        // broadcast(new ProjectUpdated($project));
        // $users->notify(new UserCreatedNotification($user));
        // foreach ($users as $singleUser) {
        // }
    

        return ResponseHelper::success([
            'user' => $user,
            'bearer_token' => $token,
            'token_type' => 'Bearer'
        ], 'User created successfully');
    }

    public function login(LoginRequest $request): JsonResponse
    {

        $loginData = $this->authService->login($request->validated());

        if (!$loginData) {
            return ResponseHelper::error('Invalid credentials', 401);
        }

        return ResponseHelper::success([
            'bearer_token' => $loginData['token'],
            'user' => $loginData['user'],
        ], 'Login successful');
    }

    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        $status = $this->authService->sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? ResponseHelper::success([], __($status))
            : ResponseHelper::error(__($status), 400);
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $status = $this->authService->resetPassword($request->validated());

        return $status === Password::PASSWORD_RESET
            ? ResponseHelper::success([], __($status))
            : ResponseHelper::error(__($status), 400);
    }



}
