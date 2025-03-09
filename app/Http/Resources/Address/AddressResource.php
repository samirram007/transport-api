<?php

namespace App\Http\Resources\Address;

use App\Http\Resources\Country\CountryResource;
use App\Http\Resources\State\StateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    /**
     * @OA\Schema(
     *     schema="AddressResource",
     *     title="Address Data",
     *     description="Data for address-related data",
     *     @OA\Property(property="user_id",type="integer",description="User ID associated with the address"),
     *     @OA\Property(property="address_type",type="string",description="Type of address (e.g., home, work)"),
     *     @OA\Property(property="address_line_1",type="string",description="First line of address"),
     *     @OA\Property(property="address_line_2",type="string",description="Second line of address"),
     *     @OA\Property(property="display",type="string",description="Formatted display of the address"),
     * )
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->user_id,
            'houseNo' => $this->whenNotNull($this->house_no),
            'addressType' => $this->whenNotNull($this->address_type),
            'addressLine1' => $this->whenNotNull($this->address_line_1),
            'addressLine2' => $this->whenNotNull($this->address_line_2),
            'city' => $this->whenNotNull($this->city),
            'village' => $this->whenNotNull($this->village),
            'postOffice' => $this->whenNotNull($this->post_office),
            'railStation' => $this->whenNotNull($this->rail_station),
            'policeStation' => $this->whenNotNull($this->police_station),
            'district' => $this->whenNotNull($this->district),
            'stateId' => $this->whenNotNull($this->state_id),
            'countryId' => $this->whenNotNull($this->country_id),
            'state' => new StateResource($this->whenLoaded('state')),
            'country' => new CountryResource($this->whenLoaded('country')),
            'pincode' => $this->whenNotNull($this->pincode),
            'latitude' => $this->whenNotNull($this->latitude),
            'longitude' => $this->whenNotNull($this->longitude),
            'display' => $this->display(),
        ];
    }
}
