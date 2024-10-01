<?php

use App\Http\Controllers\Api\Department\DepartmentPermissionController;
use App\Http\Controllers\Api\Status\StatusController;
use App\Http\Controllers\Api\User\AssignPermissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Department\DepartmentController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\User\RoleController;
use App\Http\Controllers\Api\PaymentMethod\PaymentMethodController;
use App\Http\Controllers\Api\SourceAccount\SourceAccountController;
use App\Http\Controllers\Api\Currency\CurrencyController;
use App\Http\Controllers\Api\Client\ClientController;
use App\Http\Controllers\Api\WorkType\WorkTypeController;
use App\Http\Controllers\Api\DirectClient\DirectClientController;
use App\Http\Controllers\Api\WorkTypeOption\WorkTypeOptionController;
use App\Http\Controllers\Api\ProjectTransaction\ProjectTransactionController;
use App\Http\Controllers\Api\Brand\BrandController;
use App\Http\Controllers\Api\Project\ProjectController;
use App\Http\Controllers\Api\ProjectAssignee\ProjectAssigneeController;

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
Route::post('create-user', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('reset-password', [AuthController::class, 'resetPassword']);

// Protected routes that require authentication
Route::middleware('auth:sanctum')->group(function () {
    // This route will now be accessible to authenticated users only
    Route::apiResource('brands', BrandController::class);


    Route::get('get-all-users', [UserController::class, 'index']);
    Route::put('update-user/{id}', [UserController::class, 'update']);
    Route::put('update-user-status/{id}', [UserController::class, 'updateStatus']);

    Route::apiResource('users', UserController::class);
    Route::apiResource('role', RoleController::class);
    //Route::apiResource('permissions', AssignPermissionController::class)->only(['index', 'store', 'update']);

     Route::apiResource('role', RoleController::class)->only(['index', 'store', 'update']);

     Route::get('roles/{role}/permissions', [RoleController::class, 'getPermissions']);

     Route::apiResource('permission', AssignPermissionController::class)->only(['index', 'store', 'update']);
     Route::get('department-permissions/{department}/{role}', [DepartmentPermissionController::class, 'getDepartmentPermissions']);
     Route::post('department-permissions', [DepartmentPermissionController::class, 'updateDepartmentPermissions']);

    // Route::prefix('role')->group(function () {
    //     Route::get('/', [RoleController::class, 'index']); // List all roles
    //     Route::post('/add-role', [RoleController::class, 'store']); // Create a new role
    //     Route::put('/update/{id}', [RoleController::class, 'update']); // Update a role
    // });

    Route::apiResource('departments', DepartmentController::class);
    Route::apiResource('status', StatusController::class);


    // Payment Methods & Source Account
    Route::apiResource('payment-methods',PaymentMethodController::class);
    Route::apiResource('source-accounts',SourceAccountController::class);
    Route::apiResource('currency', CurrencyController::class);
    Route::apiResource('clients', ClientController::class);
    Route::apiResource('work-types', WorkTypeController::class);

    Route::apiResource('direct-clients', DirectClientController::class);
    Route::apiResource('work-type-options', WorkTypeOptionController::class);
    Route::get('filter-work-type-option/{id}', [WorkTypeOptionController::class, 'filterWorkTypeOptions']);


    Route::apiResource('projects', ProjectController::class);
    Route::get('project/work-types',[ProjectController::class,'getProjectWorkTypes']);
    Route::get('get-sales-persons',[ProjectController::class,'getSalesPersons']);
    Route::post('project/{id}/upload-attachments',[ProjectController::class,'uploadAttachments']);

    Route::apiResource('project-transaction',ProjectTransactionController::class);
    Route::apiResource('project-assignee',ProjectAssigneeController::class);


});




