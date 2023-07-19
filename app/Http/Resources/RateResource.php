<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {

        return [
            'amount' => $this->amount()->value(),
            'currency' => $this->currency()->value(),
            'carrier' => $this->carrier->name()->value()
        ];
    }
}
