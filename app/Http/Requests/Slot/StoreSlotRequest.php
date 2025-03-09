<?php

namespace App\Http\Requests\Slot;

use App\Http\Middleware\NormalizeRequestKeys;
use App\Rules\TimeFormat;
use App\Traits\NormalizesFields;
use Illuminate\Foundation\Http\FormRequest;

class StoreSlotRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'unique:slots,name'],
            'vehicle_id' => ['required', 'numeric', 'exists:vehicles,id'],
            'slot_type' => ['required', 'string', 'max:255'],
            'capacity' => ['sometimes'],
            'team_id' => ['sometimes', 'string'],

      'start_time' => ['sometimes', 'regex:/^(?:[01]?\d|2[0-3]):[0-5]\d(:[0-5]\d)?$/'],
'end_time' => ['sometimes', 'regex:/^(?:[01]?\d|2[0-3]):[0-5]\d(:[0-5]\d)?$/'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
