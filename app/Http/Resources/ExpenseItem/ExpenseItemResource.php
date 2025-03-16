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
            'amount' => $this->amount,
            'is_deleted'=> $this->is_deleted,
            "expenseHead"=>new ExpenseHeadResource($this->whenLoaded('expense_head')),
        ];
    }
}
