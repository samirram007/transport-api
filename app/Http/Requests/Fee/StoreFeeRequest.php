<?php

namespace App\Http\Requests\Fee;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeeRequest extends FormRequest
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
    'fee_date'=> ['required', 'date'],
    'rider_id' =>  ['required','numeric', 'exists:riders,id'],
    'quantity'=> ['required', 'numeric'],
    'months'=> ['sometimes','required', 'array'],
    'is_waived'=> ['sometimes','required', 'boolean'],

];

        // return [
        //     'fee_no'=> ['required','string','max:255'],
        //     'fee_date'=> ['required', 'date'],
        //     'fee_template_id'=> ['required', 'exists:fee_templates,id'],
        //     'student_id' =>  ['required','numeric', 'exists:users,id'],
        //     'academic_session_id'=> ['required', 'exists:academic_sessions,id'],
        //     'student_session_id'=> ['required', 'exists:student_sessions,id'],
        //     'campus_id'=> ['required', 'exists:campuses,id'],
        //     'academic_class_id'=> ['required', 'exists:academic_classes,id'],
        //     'total_amount'=> ['required', 'numeric'],
        //     'paid_amount'=> ['sometimes','required', 'numeric'],
        //     'balance_amount'=> ['sometimes','required', 'numeric'],
        //     'payment_mode'=> ['sometimes','required','string','max:255'],
        //     'note'=> ['sometimes','nullable','string','max:255'],
        //     'fee_items'=> ['sometimes','required', 'array'],
        //     'fee_items.*.fee_head_id'=> ['required', 'exists:fee_heads,id'],
        //     'fee_items.*.quantity'=> ['required', 'numeric'],
        //     'fee_items.*.is_customizable'=> ['required', 'numeric'],
        //     'fee_items.*.keep_periodic_details'=> ['required', 'numeric'],
        //     'fee_items.*.is_active'=> ['required', 'numeric'],
        //     'fee_items.*.months'=> ['sometimes','nullable'],
        //     'fee_items.*.amount'=> ['required', 'numeric'],
        //     'fee_items.*.total_amount'=> ['required', 'numeric'],

        // ];
    }


}
