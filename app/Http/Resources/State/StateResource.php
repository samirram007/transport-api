<?php

namespace App\Http\Resources\State;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'stateCode' => $this->state_code,
            'countryId' => $this->country_id,
        ];
    }
}
