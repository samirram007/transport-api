<?php

namespace App\Http\Resources\School;

use App\Http\Resources\Address\AddressResource;
use App\Http\Resources\Document\DocumentResource;
use App\Http\Resources\EducationBoard\EducationBoardResource;
use App\Http\Resources\SchoolType\SchoolTypeResource;
use App\Http\Resources\SuccessResource;
use Illuminate\Http\Request;

class SchoolResource extends SuccessResource
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
            'code' => $this->whenNotNull($this->code),
            'addressId' => $this->whenNotNull($this->address_id),
            'address' => new AddressResource($this->whenLoaded('address')),
            'contactNo' => $this->whenNotNull($this->contact_no),
            'email' => $this->whenNotNull($this->email),
            'website' => $this->whenNotNull($this->website),


        ];
    }
}
