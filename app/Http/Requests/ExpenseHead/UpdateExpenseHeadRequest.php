<?php

namespace App\Http\Requests\ExpenseHead;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateExpenseHeadRequest extends FormRequest
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
            'name' => ['required','string','max:255',Rule::unique('expense_heads', 'name')->ignore($this->route('expense_head'))],

            'expense_group_id' => ['sometimes','nullable','numeric',],
        ];
    }
}
