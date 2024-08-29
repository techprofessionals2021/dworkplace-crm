<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        dd($user->getDepartmentPermissions());
        $users = UserResource::collection($this->userService->getAllUsers());
        return ResponseHelper::success($users, 'User list retrieved successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd('asd');
        $user = $this->userService->updateUser($id, $request->all());

        return ResponseHelper::success($user, 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function updateStatus(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'status_id' => 'required|integer|exists:statuses,id',
        ]);

        // Update the user status
        $user = $this->userService->updateUserStatus($id, $request->status_id);

        return ResponseHelper::success($user, 'User status updated successfully');
    }
}
