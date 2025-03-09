<?php

namespace App\Http\Resources\ExpenseHead;

use App\Http\Resources\ExpenseGroup\ExpenseGroupResource;
use App\Http\Resources\SuccessResource;
use Illuminate\Http\Request;


class ExpenseHeadResource extends SuccessResource
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
            'name' => $this->name,
            'expenseGroupId' => $this->expense_group_id,
            "expenseGroup"=>new ExpenseGroupResource($this->whenLoaded('expense_group')),

        ] ;
    }
}
