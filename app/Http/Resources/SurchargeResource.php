<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SurchargeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $rateData = $this->rate ? RateResource::collection($this->rate) : null;

        return [
            'id' => $this->id()->value(),
            'name' => $this->name()->value(),
            'relationships' => [
                'standard_surcharge_name' => StandardSurchargeResource::make($this->standardSurchargeName),
                'calculation_type' => CalculationTypeResource::make($this->calculationType),
                'rate' => $rateData,
            ],
            'apply_to' => $this->applyTo()->value(),

        ];
    }
}
