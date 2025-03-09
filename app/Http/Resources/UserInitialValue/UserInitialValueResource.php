<?php

namespace App\Http\Resources\UserInitialValue;

use App\Http\Resources\User\UserResource;
use App\Http\Resources\UserInitialValueType\UserInitialValueTypeResource;
use App\Http\Resources\SuccessResource;
use Illuminate\Http\Request;

class UserInitialValueResource extends SuccessResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'key' => $this->key,
            'value' => $this->value,
            'userId' => $this->user_id,
            'user' => new UserResource($this->whenLoaded('user')),

        ];
    }
}
