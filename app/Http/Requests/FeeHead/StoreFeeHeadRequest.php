<?php

namespace App\Http\Requests\FeeHead;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeeHeadRequest extends FormRequest
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
            'name' => ['required','string','max:255','unique:fee_heads,name'],
            'income_group_id' => ['sometimes','nullable','numeric',],
        ];

    }
}
