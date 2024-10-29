<?php

namespace App\Http\Controllers\Api\Status;

use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Services\Status\StatusService;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    protected $statusService;
                                                
    public function __construct(StatusService $statusService)
    {
        $this->statusService = $statusService;
    }


    public function index()
    {
        $statuses = $this->statusService->getAllStatuses();
        return ResponseHelper::success($statuses, 'Statuses retrieved successfully');
    }

}
