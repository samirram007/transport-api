<?php

namespace App\Http\Resources\ExpenseItem;

use App\Http\Resources\ExpenseHead\ExpenseHeadResource;
use App\Http\Resources\SuccessResource;
use Illuminate\Http\Request;


class ExpenseItemResource extends SuccessResource
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
            'expenseId' => $this->expense_id,
            'expenseHeadId' => $this->expense_head_id,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
            'totalAmount' => $this->total_amount,
            'months' => $this->months,
            "expenseHead"=>new ExpenseHeadResource($this->whenLoaded('expense_head')),
        ];
    }
}
