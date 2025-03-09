<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('vehicles', 'name')->ignore($this->route('vehicle'))
            ],
            'registration_no' => ['sometimes', 'max:255', 'unique:vehicles,registration_no'],

            'registration_date' => ['sometimes', 'date'],
            'registration_valid_date' => ['sometimes', 'date'],
            'chassis_no' => ['sometimes', 'string'],
            'engine_no' => ['sometimes', 'string'],
            'color' => ['sometimes', 'string'],
            'capacity' => ['sometimes', 'numeric'],
            'insurance_id' => ['sometimes', 'numeric'],
            'vehicle_type_id' => ['sometimes', 'numeric', 'exists:vehicle_types,id'],
        ];
    }
}
