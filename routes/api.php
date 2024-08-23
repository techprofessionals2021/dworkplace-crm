<?php

use App\Http\Controllers\Api\User\AssignPermissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\User\RoleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Protected routes that require authentication
Route::middleware('auth:sanctum')->group(function () {
    // This route will now be accessible to authenticated users only
    Route::get('get-all-users', [UserController::class, 'index']);
    Route::put('update-user/{id}', [UserController::class, 'update']);
    Route::put('update-user-status/{id}', [UserController::class, 'updateStatus']);


     Route::apiResource('role', RoleController::class)->only(['index', 'store', 'update']);

     Route::apiResource('permission', AssignPermissionController::class)->only(['index', 'store', 'update']);


});



Route::post('create-user', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('reset-password', [AuthController::class, 'resetPassword']); 