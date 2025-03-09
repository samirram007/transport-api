<?php

namespace App\Http\Requests\Slot;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSlotRequest extends FormRequest
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
            'name' => ['sometimes','string','max:255',
                Rule::unique('slots', 'name')->ignore($this->route('slot'))
            ],
           'slot_type' => ['sometimes','string','max:255'],
           'vehicle_id' => ['sometimes', 'numeric', 'exists:vehicles,id'],
            'capacity' => ['sometimes',],
            'team_id' => ['sometimes', 'string'],

            'start_time' => ['sometimes', 'regex:/^(?:[01]?\d|2[0-3]):[0-5]\d(:[0-5]\d)?$/'],
'end_time' => ['sometimes', 'regex:/^(?:[01]?\d|2[0-3]):[0-5]\d(:[0-5]\d)?$/'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
