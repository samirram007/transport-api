<?php

namespace App\Http\Resources\Fee;

use App\Http\Resources\AcademicClass\AcademicClassResource;
use App\Http\Resources\AcademicSession\AcademicSessionResource;
use App\Http\Resources\Campus\CampusResource;
use App\Http\Resources\FeeItem\FeeItemCollection;
use App\Http\Resources\FeeItemMonth\FeeItemMonthCollection;
use App\Http\Resources\FeeTemplate\FeeTemplateResource;
use App\Http\Resources\FiscalYear\FiscalYearResource;
use App\Http\Resources\Rider\RiderResource;
use App\Http\Resources\StudentSession\StudentSessionCollection;
use App\Http\Resources\StudentSession\StudentSessionResource;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\User\UserResource;

use App\Models\FiscalYear;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeeResource extends SuccessResource
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
            'feeNo' => $this->fee_no,
            'feeDate' => $this->fee_date,

            'riderId' => $this->rider_id,
            'riderSnapshotId' => $this->rider_snapshot_id,

            'fiscalYearId' => $this->fiscal_year_id,
            'totalAmount' => $this->total_amount,
            'paidAmount' => $this->paid_amount,
            'balanceAmount' => $this->balance_amount,
            'paymentMode' => $this->payment_mode,
            'isDeleted'=>$this->is_deleted,
            // 'note'=>$this->note,

            "rider" => new RiderResource($this->whenLoaded('rider')),
            "riderSnapshot" => new RiderResource($this->whenLoaded('rider_snapshot')),
            'fiscalYear'=>new FiscalYearResource($this->whenLoaded('fiscal_year')),
            "feeItems" => new FeeItemCollection($this->whenLoaded('fee_items')),
            "feeItemMonths" => new FeeItemMonthCollection($this->whenLoaded('fee_item_months')),
             ];
    }
}

