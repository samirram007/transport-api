<?php

namespace App\Http\Resources\Vehicle;

use App\Http\Resources\Address\AddressResource;
use App\Http\Resources\Document\DocumentResource;
use App\Http\Resources\EducationBoard\EducationBoardResource;
use App\Http\Resources\VehicleType\VehicleTypeResource;
use App\Http\Resources\SuccessResource;
use Illuminate\Http\Request;

class VehicleResource extends SuccessResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'registration_no' => $this->whenNotNull($this->registration_no),
            'registration_date' => $this->whenNotNull($this->registration_date),
            'registration_valid_date' => $this->whenNotNull($this->registration_valid_date),
            'chassis_no' => $this->whenNotNull($this->chassis_no),
            'engine_no' => $this->whenNotNull($this->engine_no),
            'color' => $this->whenNotNull($this->color),
            'capacity' => $this->whenNotNull($this->capacity),
            'insurance_id' => $this->whenNotNull($this->insurance_id),
            'vehicleTypeId' => $this->whenNotNull($this->vehicle_type_id),
            'vehicleType' => new VehicleTypeResource($this->whenLoaded('vehicle_type')),

        ];
    }
}
