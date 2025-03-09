<?php

namespace App\Http\Resources\RiderSnapshot;

use App\Http\Resources\Address\AddressResource;
use App\Http\Resources\Document\DocumentResource;
use App\Http\Resources\EducationBoard\EducationBoardResource;
use App\Http\Resources\Fee\FeeCollection;
use App\Http\Resources\RiderType\RiderTypeResource;
use App\Http\Resources\School\SchoolResource;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\Vehicle\VehicleResource;
use Illuminate\Http\Request;

class RiderSnapshotResource extends SuccessResource
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
            'userId' => $this->user_id,
            'name' => $this->name,
            'code' => $this->whenNotNull($this->code),
            // 'addressId' => $this->whenNotNull($this->address_id),
            // 'address' => new AddressResource($this->whenLoaded('address')),
            'contactNo' => $this->whenNotNull($this->contact_no),
            'email' => $this->whenNotNull($this->email),
            'riderType' => $this->whenNotNull($this->rider_type),
            'schoolId' => $this->whenNotNull($this->school_id),
            'school' => $this->whenNotNull(new SchoolResource($this->whenLoaded('school'))),
            'vehicleId' => $this->whenNotNull($this->vehicle_id),
            'vehicle' => $this->whenNotNull(new VehicleResource($this->whenLoaded('vehicle'))),

            'schoolTime' => $this->whenNotNull($this->school_time),
            'standard' => $this->whenNotNull($this->standard),
            'section' => $this->whenNotNull($this->section),
            'rollNo' => $this->whenNotNull($this->roll_no),
            'monthlyCharge'=> $this->whenNotNull($this->monthly_charge),
            'nextFeesDate'=> $this->whenNotNull($this->next_fees_date),


            'profileDocumentId' => $this->whenNotNull($this->profile_document_id),
            'profileDocument' => $this->whenNotNull(new DocumentResource($this->whenLoaded('profile_document'))),

            'fees'=> $this->whenNotNull(new FeeCollection($this->whenLoaded('fees'))),
            'riderSnapshots'=> $this->whenNotNull(new RiderSnapshotCollection($this->whenLoaded('rider_snapshots'))),


        ];
    }
}
