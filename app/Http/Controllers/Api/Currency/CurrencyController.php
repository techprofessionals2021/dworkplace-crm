<?php

namespace App\Http\Controllers\Api\Currency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\Response\ResponseHelper;
use App\Http\Requests\Currency\StoreRequest;
use App\Http\Resources\Currency\CurrencyResource;
use App\Services\Currency\CurrencyService;


class CurrencyController extends Controller
{
    protected $currencyService;
    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = $this->currencyService->getAllCurrencies();
        $allCurrencies = CurrencyResource::collection($currencies);
        return ResponseHelper::success($allCurrencies, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $currency = $this->currencyService->createCurrency($validated);
        return ResponseHelper::success($currency, "Currency Created Successfully", Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $currency = $this->currencyService->getCurrencyById($id);
        if(!$currency){
            return ResponseHelper::error('Currency Not Found', Response::HTTP_NOT_FOUND);
        }else{
            $currencyResource = new CurrencyResource($currency);
            return ResponseHelper::success($currencyResource, "Currency Fetched Successfully", Response::HTTP_OK);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        $validated = $request->validated();
        $currency = $this->currencyService->updateCurrencyById($validated, $id);

        if(!$currency){
            return ResponseHelper::error('Currency Not Found', Response::HTTP_NOT_FOUND);
        } else {
            $currencyResource = new CurrencyResource($currency);
            return ResponseHelper::success($currencyResource, "Currency Updated Successfully", Response::HTTP_OK);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->currencyService->deleteCurrency($id);
        if(!$deleted){
            return ResponseHelper::error('Currency Not Found', Response::HTTP_NOT_FOUND);
        } else {
            return ResponseHelper::success(null, "Currency Deleted Successfully",Response::HTTP_NO_CONTENT);
        }
    }
}
