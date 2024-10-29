<?php

namespace App\Http\Controllers\Api\PaymentMethod;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Http\Requests\PaymentMethod\StoreRequest;
use App\Helpers\Response\ResponseHelper;
use Illuminate\Http\Response;
use App\Services\PaymentMethod\PaymentMethodService;
use App\Http\Resources\PaymentMethod\PaymentMethodResource;

class PaymentMethodController extends Controller
{
    protected $paymentMethodService;

    public function __construct(PaymentMethodService $paymentMethodService)
    {
        $this->paymentMethodService = $paymentMethodService;
    }

    public function index()
    {
        $paymentMethods = $this->paymentMethodService->getAllPaymentMethods();
        $allPaymentMethods = PaymentMethodResource::collection($paymentMethods);
        return ResponseHelper::success($allPaymentMethods, 'PaymentMethods retrieved successfully');

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
    public function store(StoreRequest $request)
    {
         $paymentMethod= $this->paymentMethodService->createPaymentMethod($request->validated());
         return ResponseHelper::success($paymentMethod, 'PaymentMethod created successfully');
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
    public function update(StoreRequest $request, string $id)
    {
        $paymentMethod = $this->paymentMethodService->updatePaymentMethod($request->validated(), (int) $id);
        return ResponseHelper::success($paymentMethod, 'Payment Method updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
     
        $deleted = $this->paymentMethodService->deletePaymentMethod($id);

        if (!$deleted) {
            return ResponseHelper::error('PaymentMethod not found', Response::HTTP_NOT_FOUND);
        }

        return ResponseHelper::success("PaymentMethod deleted successfully",Response::HTTP_NO_CONTENT);
    }
}
