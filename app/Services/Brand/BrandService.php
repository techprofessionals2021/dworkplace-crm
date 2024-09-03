<?php

namespace App\Services\Brand;

use App\Models\Brand\Brand;

class BrandService
{
    public function getAllBrands() {
        return Brand::all();
    }

    public function createBrand(array $data)
    {
        return Brand::create($data);
    }

    public function getBrandById($id){
        return Brand::find($id);
    }

    public function updateBrand($id, $data)
    {
        $brand = Brand::find($id);
        if(!$brand){
            return null;
        }
        else{
            $brand->update($data);
            return $brand;
        }
    }

    public function deleteBrand($id)
    {
        $brand = $this->getBrandById($id);
        if(!$brand){
            return null;
        }
        else{
            return $brand->delete();
        }
    }
}
