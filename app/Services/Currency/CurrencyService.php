<?php

namespace App\Services\Currency;
use App\Models\Currency\Currency;

class CurrencyService
{
    public function getAllCurrencies()
    {
        return Currency::all();
    }

    public function createCurrency($data)
    {
        return Currency::create($data);
    }

    public function getCurrencyById($id)
    {
        return Currency::find($id);
    }

    public function updateCurrencyById($data, $id)
    {
        $currency = $this->getCurrencyById($id);

        if(!$currency){
            return null;
        }
        else {
            $currency->update($data);
            return $currency;
        }
    }

    public function deleteCurrency($id)
    {
        $currency = $this->getCurrencyById($id);
        if(!$currency){
            return null;
        }
        else{
            return $currency->delete();
        }
    }
}
