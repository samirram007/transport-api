<?php

namespace App\Http\Resources\FeeItemMonth;

use App\Http\Resources\Fee\FeeResource;
use App\Http\Resources\Month\MonthResource;
use App\Http\Resources\Rider\RiderResource;
use App\Http\Resources\SuccessResource;
use Illuminate\Http\Request;


class FeeItemMonthResource extends SuccessResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'feeId' => $this->fee_id,
            'feeItemId' => $this->fee_item_id,
            'riderId' => $this->rider_id,
            'year' => $this->year,
            'monthId' => $this->month_id,
            'amount' => $this->amount,
            'isWaived' => $this->is_waived,

            'fee' => new FeeResource($this->whenLoaded('fee')),
            'month'=> new MonthResource($this->whenLoaded('month')),
            'rider'=> new RiderResource($this->whenLoaded('rider')),
            'feeItem'=> new RiderResource($this->whenLoaded('fee_item')),

        ];
    }
}
