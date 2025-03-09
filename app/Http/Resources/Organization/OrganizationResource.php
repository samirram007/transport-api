<?php

namespace App\Http\Resources\Organization;

use App\Http\Resources\Address\AddressResource;
use App\Http\Resources\Document\DocumentResource;
use App\Http\Resources\EducationBoard\EducationBoardResource;
use App\Http\Resources\OrganizationType\OrganizationTypeResource;
use App\Http\Resources\SuccessResource;
use Illuminate\Http\Request;

class OrganizationResource extends SuccessResource
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
            'establishmentDate' => $this->whenNotNull($this->establishment_date),
            'logoImageId' => $this->whenNotNull($this->logo_image_id),
            'logoImage' => $this->whenNotNull(new DocumentResource($this->whenLoaded('logo_image'))),


        ];
    }
}