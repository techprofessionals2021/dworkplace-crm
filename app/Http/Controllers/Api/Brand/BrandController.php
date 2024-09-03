<?php

namespace App\Http\Controllers\Api\Brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\Response\ResponseHelper;
use App\Services\Brand\BrandService;
use App\Http\Resources\Brand\BrandResource;
use App\Http\Requests\Brand\StoreRequest;

class BrandController extends Controller
{
    protected $brandService;
    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = $this->brandService->getAllBrands();
        $allBrands = BrandResource::collection($brands);
        return ResponseHelper::success($allBrands, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $brand = $this->brandService->createBrand($validated);
        return ResponseHelper::success($brand, "Brand Created Successfully", Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = $this->brandService->getBrandById($id);
        if(!$brand){
            return ResponseHelper::error('Brand Not Found', Response::HTTP_NOT_FOUND);
        }else{
            $brand_resource = new BrandResource($brand);
            return ResponseHelper::success($brand_resource, "Brand Fetched Successfully", Response::HTTP_OK);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, string $id)
    {
        $validated = $request->validated();
        $brand = $this->brandService->updateBrand($id, $validated);

        if(!$brand){
            return ResponseHelper::error('Brand Not Found', Response::HTTP_NOT_FOUND);
        }
        else{
            $brand_resource = new BrandResource($brand);
            return ResponseHelper::success($brand_resource, "Brand Fetched Successfully", Response::HTTP_OK);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->brandService->deleteBrand($id);

        if (!$deleted) {
            return ResponseHelper::error('Brand Not Found', Response::HTTP_NOT_FOUND);
        } else{
            return ResponseHelper::success(null, "Brand Deleted Successfully",Response::HTTP_NO_CONTENT);
        }
    }
}
