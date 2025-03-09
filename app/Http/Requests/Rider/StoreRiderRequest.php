<?php

namespace App\Http\Requests\Rider;

use App\Http\Middleware\NormalizeRequestKeys;
use App\Traits\NormalizesFields;
use Illuminate\Foundation\Http\FormRequest;

class StoreRiderRequest extends FormRequest
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
            'name' => ['required', 'max:255',],
            'code' => ['sometimes', 'max:255', 'unique:riders,code'],
            'school_id' => ['sometimes', 'numeric','exists:schools,id'],
            'contact_no' => ['sometimes', 'string', 'max:10'],
            'email' => ['sometimes', 'string', 'max:50'],
            'website' => ['sometimes', 'string', 'max:50'],
            'rider_type' => ['sometimes', 'string', 'max:50'],
            'vehicle_id' => ['sometimes', 'numeric', 'exists:vehicles,id'],
            'standard' => ['sometimes', 'string', 'max:50'],
            'section' => ['sometimes', 'string', 'max:50'],
            'roll_no' => ['sometimes', 'numeric'],
            'school_time' => ['sometimes', 'string', 'max:50'],
            'monthly_charge' => ['sometimes', 'numeric'],
            'profile_document_id' => ['sometimes', 'numeric', 'exists:documents,id'],
        ];
    }
}
