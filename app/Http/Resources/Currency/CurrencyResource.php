<?php

namespace App\Http\Resources\Currency;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>@$this->id,
            'name' => @$this->name,
            'symbol' => @$this->symbol,
            'conversion_rate' => @$this->conversion_rate
        ];
    }
}
