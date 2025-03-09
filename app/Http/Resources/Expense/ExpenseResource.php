<?php

namespace App\Http\Resources\Expense;

use App\Http\Resources\AcademicSession\AcademicSessionResource;
use App\Http\Resources\Campus\CampusResource;
use App\Http\Resources\Document\DocumentResource;
use App\Http\Resources\ExpenseItem\ExpenseItemCollection;
use App\Http\Resources\FiscalYear\FiscalYearResource;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\User\UserResource;

use Illuminate\Http\Request;

class ExpenseResource extends SuccessResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'expenseNo' => $this->expense_no,
            'voucherNo' => $this->voucher_no,
            'expenseDate' => $this->expense_date,
            'userId' => $this->user_id,
            'fiscalYearId' => $this->academic_session_id,
            'totalAmount' => $this->total_amount,
            'paidAmount' => $this->paid_amount,
            'balanceAmount' => $this->balance_amount,
            'paymentMode' => $this->payment_mode,
            'narration' => $this->narration,
            'documentId' => $this->document_id,
            "fiscalYear" => new FiscalYearResource($this->whenLoaded('academic_session')),
            "document" => new DocumentResource($this->whenLoaded('document')),
            "user" => new UserResource($this->whenLoaded('user')),
            "expenseItems" => new ExpenseItemCollection($this->whenLoaded('expense_items')),
        ];
    }
}