<?php

namespace App\Http\Resources\Slot;

use App\Http\Resources\Address\AddressResource;
use App\Http\Resources\Document\DocumentResource;
use App\Http\Resources\EducationBoard\EducationBoardResource;
use App\Http\Resources\SlotType\SlotTypeResource;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\Vehicle\VehicleResource;
use Illuminate\Http\Request;

class SlotResource extends SuccessResource
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
            'slotType' => $this->whenNotNull($this->slot_type),
            'vehicleId' => $this->whenNotNull($this->vehicle_id),
            'vehicle' => new VehicleResource($this->whenLoaded('vehicle')),
            'capacity' => $this->whenNotNull($this->capacity),
            'startTime' => $this->whenNotNull($this->start_time),
            'endTime' => $this->whenNotNull($this->end_time),
            'isActive' => $this->whenNotNull($this->is_active),


        ];
    }
}
