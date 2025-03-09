<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrganizationRequest extends FormRequest
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
                Rule::unique('organizations', 'name')->ignore($this->route('organization'))
            ],
            'code' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('organizations', 'code')->ignore($this->route('organization'))
            ],
            'address_id' => ['sometimes', 'numeric'],
            'organization_id' => ['sometimes', 'numeric', 'exists:organizations,id'],
            'education_board_id' => ['sometimes', 'numeric', 'exists:education_boards,id'],
            'contact_no' => ['sometimes', 'string', 'max:10'],
            'email' => ['sometimes', 'string', 'max:50'],
            'website' => ['sometimes', 'string', 'max:50'],
            'organization_type_id' => ['sometimes', 'numeric', 'exists:organization_types,id'],
            'establishment_date' => ['sometimes', 'date'],
            'opening_time' => ['sometimes', 'time'],
            'closing_time' => ['sometimes', 'time'],
            'logo_image_id' => ['sometimes', 'numeric', 'exists:documents,id'],
        ];
    }
}