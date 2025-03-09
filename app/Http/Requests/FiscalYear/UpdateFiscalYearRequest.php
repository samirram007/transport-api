<?php

namespace App\Http\Requests\FiscalYear;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFiscalYearRequest extends FormRequest
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
            'name' => ['sometimes', 'required'],
            'start_date' => ['sometimes', 'nullable', 'date'],
            'end_date' => ['sometimes', 'nullable', 'date', 'after:start_date'],
            'previous_fiscal_year_id' => ['sometimes', 'nullable', 'numeric', 'exists:fiscal_years,id'],
            'next_fiscal_year_id' => ['sometimes', 'nullable', 'numeric', 'exists:fiscal_years,id'],
            'is_current' => ['sometimes', 'nullable', 'boolean'],
        ];
    }
}