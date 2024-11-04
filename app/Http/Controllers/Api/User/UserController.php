<?php

namespace App\Http\Controllers\Api\User;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use  App\Models\User;

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
    public function update(UpdateRequest $request, $id)
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


    public function getDepartmentUser(Request $request)
   {
    $ids = $request->input('id');

    if (!is_array($ids)) {
        $ids = [$ids];
    }
    $users = User::whereHas('departments', function($query) use ($ids) {
        $query->whereIn('department_id', $ids);
    })->get();

    return ResponseHelper::success($users, 'department User has successfully fetched');
   }

    public function updateUserPassword(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'password' => 'required|min:8', // Ensure password is secure
        ]);

        $user = $this->userService->updateUserPassword($validatedData);

        return ResponseHelper::success($user, 'User Password Updated Successfully');
    }
  }
