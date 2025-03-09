<?php

namespace App\Http\Requests\InitialValue;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInitialValueRequest extends FormRequest
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
            'name' => ['sometimes', 'string', 'max:255', 'unique:amenities,name,'.$this->id],
            'description' => ['sometimes', 'string', 'max:255'],
            'initialvalue_type_id' => ['sometimes', 'exists:initialvalue_types,id'],
        ];
    }
}
