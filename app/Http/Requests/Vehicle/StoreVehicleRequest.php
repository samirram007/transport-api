<?php

namespace App\Http\Requests\Vehicle;

use App\Http\Middleware\NormalizeRequestKeys;
use App\Traits\NormalizesFields;
use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'unique:vehicles,name'],
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
