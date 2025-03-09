<?php

namespace App\Http\Resources\FeeItemMonth;

use App\Http\Resources\Month\MonthResource;
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
            'feeItemId' => $this->fee_item_id,
            'yearId' => $this->year_id,
            'monthId' => $this->month_id,
            'amount' =>floatval($this->amount),

        ];
    }
}
