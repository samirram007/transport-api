<?php

namespace App\Http\Requests\Expense;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
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
     //   dd(request()->all());

        return [
            'expense_no'=> ['required','string','max:255'],
            'voucher_no'=> ['sometimes','string','max:255'],
            'expense_date'=> ['required', 'date'],
            'total_amount'=> ['required', 'numeric'],
            'payment_mode'=> ['sometimes','required','string','max:255'],
            'note'=> ['sometimes','required','string','max:255'],
            'document_id'=>['sometimes','required','numeric'],
            'expense_items'=> ['sometimes','required', 'array'],
            'expense_items.*.expense_head_id'=> ['required', 'exists:expense_heads,id'],
            'expense_items.*.amount'=> ['required', 'numeric'],

        ];
    }


}
