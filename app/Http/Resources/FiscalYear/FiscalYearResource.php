<?php

namespace App\Http\Resources\FiscalYear;

use Illuminate\Http\Request;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\Campus\CampusResource;

class FiscalYearResource extends SuccessResource
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
            'name' => $this->whenNotNull($this->name),
            'year' => $this->whenNotNull($this->name),
            'startDate' => $this->whenNotNull($this->start_date),
            'endDate' => $this->whenNotNull($this->end_date),
            'previousFiscalYearId' => $this->whenNotNull($this->previous_fiscal_year_id),
            'nextFiscalYearId' => $this->whenNotNull($this->next_fiscal_year_id),
            "previousFiscalYear" => new FiscalYearResource($this->whenLoaded('previous_fiscal_year')),
            "nextFiscalYear" => new FiscalYearResource($this->whenLoaded('next_fiscal_year')),
            'isCurrent' => $this->whenNotNull($this->is_current),
            'isActive' => $this->whenNotNull($this->is_active),
        ];
    }
}
