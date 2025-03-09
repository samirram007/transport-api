<?php

namespace App\Http\Resources\FeeItem;

use App\Http\Resources\FeeHead\FeeHeadResource;
use App\Http\Resources\FeeItemMonth\FeeItemMonthCollection;
use App\Http\Resources\SuccessResource;
use Illuminate\Http\Request;


class FeeItemResource extends SuccessResource
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
            'feeId' => $this->fee_id,
            'feeHeadId' => $this->fee_head_id,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
            'totalAmount' => $this->total_amount,
            'months' => $this->months,
            'isActive'=>$this->is_active,
            'isDeleted'=>$this->is_deleted,
            'isCustomizable'=>$this->is_customizable,
            'keepPeriodicDetails'=>$this->keep_periodic_details,
            "feeHead"=>new FeeHeadResource($this->whenLoaded('fee_head')),
             "feeItemMonths"=>new FeeItemMonthCollection($this->whenLoaded('fee_item_months')),
        ];
    }
}
