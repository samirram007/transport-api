<?php

namespace App\Http\Requests\FeeItemMonth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFeeItemMonthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fee_id' => 'sometimes|nullable|integer',
            'fee_item_id' => 'sometimes|nullable|integer',
            'rider_id' => 'required|integer',
            'year' => 'required|integer',
            'month_id' => 'required|integer',
            'is_waived' => 'sometimes|boolean', // Defaults to false if not provided
            'amount' => 'required|numeric|min:0', // Allow 0 as a valid amount
        ];
    }
}
