<?php

namespace App\Http\Resources\Month;

use App\Http\Resources\FeeHead\FeeHeadResource;
use App\Http\Resources\SuccessResource;
use Illuminate\Http\Request;


class MonthResource extends SuccessResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       // dd($request->all());
        return [
            'id' => $this->id,
            'name' => $this->name,
            'shortName' => $this->short_name,
            'number' => $this->number,
            'noOfDays' => $this->no_of_days,
            'isFebruary' => $this->is_february,
        ];
    }
}
