<?php

namespace App\Services\impl;

use App\Exceptions\ModelNotFoundException as ExceptionsModelNotFoundException;
use App\Http\Requests\Fee\StoreFeeRequest;
use App\Http\Requests\Fee\UpdateFeeRequest;
use App\Http\Resources\Fee\FeeCollection;
use App\Http\Resources\Fee\FeeResource;
use App\Models\Fee;
use App\Models\FeeItem;
use App\Models\FeeItemMonth;
use App\Models\Month;
use App\Models\Rider;
use App\Models\UserInitialValue;
use App\Services\IFeeService;
use DB;
use Exception;
use Illuminate\Validation\ValidationException;

class FeeService implements IFeeService
{
    protected $resourceLoader;

    public function __construct()
    {
        $this->resourceLoader = [
            'fee_items.fee_item_months.month',
            'fee_items.fee_head',
            'fee_item_months',
            'rider' => [
                'school',
                'vehicle.vehicle_type',
            ],
            'rider_snapshot' => [
                'school',
                'vehicle.vehicle_type',
            ],
            'pickup_slot',
            'drop_slot',
        ];
    }

    public function getAll()
    {

        $message = [];

        $request = request();
        // dd($request);
        if (!$request->has('fiscal_year_id')) {

            array_push($message, 'Please provide Fiscal year');
            return response()->json(
                [
                    'status' => false,
                    'message' => $message,
                ]
                ,
                400
            );
        } elseif ($request->has('from') && $request->has('to')) {



            $fee = Fee::with($this->resourceLoader)
                ->whereBetween('fee_date', [$request->input('from'), $request->input('to')])
                ->get();
            //dd($fee->toArray());
            return FeeCollection::make($fee);
        } else {
            array_push($message, 'Date range is required');
            return response()->json(
                [
                    'status' => false,
                    'message' => $message,
                ]
                ,
                400
            );
        }

    }

    public function getById($id)
    {

        try {
            $response = Fee::findOrFail($id);

            return FeeResource::make($response->load($this->resourceLoader));
        } catch (Exception $e) {
            // Handle the case where the model is not found
            // throw new ExceptionsModelNotFoundException($e);
            // return new ExceptionsModelNotFoundException($e);
            return response()->json([
                'status' => false,
                'message' => 'Record not found.',
                'code' => 404,
            ], 404);
        }
    }


    public function store(StoreFeeRequest $request)
    {
        DB::beginTransaction(); // Start transaction

        try {
            $validatedRequest = $request->validated();
            $rider = Rider::findOrFail($validatedRequest['rider_id']);

            // Check if fees are already paid for selected months
            $existingMonths = FeeItemMonth::where('rider_id', $rider->id)
                ->whereIn('month_id', $validatedRequest['months'])
                ->pluck('month_id')
                ->toArray();

            $duplicateMonths = array_intersect($validatedRequest['months'], $existingMonths);
            if (!empty($duplicateMonths)) {
                return response()->json(
                    [
                        'status' => false,
                        'message' => 'Fees already paid for months: ' . implode(', ', $duplicateMonths),
                    ]
                    ,
                    400
                );
                // throw ValidationException::withMessages([
                //     'months' => 'Fees already paid for months: ' . implode(', ', $duplicateMonths),
                // ]);
            }

            if ($validatedRequest['is_waived'] == true) {

                $feeItemMonthsData = [];
                foreach ($validatedRequest['months'] as $month) {
                    $feeItemMonthsData[] = [
                        'rider_id' => $rider->id,
                        'month_id' => $month,
                        'year' => $this->getCurrentFiscalyear(),
                        'is_waived'=> $validatedRequest['is_waived'],
                        'amount' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                FeeItemMonth::insert($feeItemMonthsData); // Bulk insert for efficiency

                DB::commit(); // Commit transaction

                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Fees waived successfully.',
                    ]
                    ,
                    200
                );
            }


            $months = Month::whereIn('id', $validatedRequest['months'])->get();
            $monthNames = $months->pluck('short_name')->implode(', ');






            // Prepare Fee Data
            $validatedRequest['rider_snapshot_id'] = $rider->rider_snapshot_id;
            $validatedRequest['fee_date'] = now()->toDateString();
            $validatedRequest['fee_no'] = $this->getFeeNo();
            $validatedRequest['total_amount'] = $rider->monthly_charge * $validatedRequest['quantity'];
            $validatedRequest['paid_amount'] = $validatedRequest['total_amount'];
            $validatedRequest['balance_amount'] = 0;
            $validatedRequest['payment_mode'] = 'cash';
            $validatedRequest['note'] = "{$validatedRequest['total_amount']} Paid by {$rider->name} for {$validatedRequest['quantity']} months ({$monthNames})";
            $validatedRequest['fiscal_year_id'] = $this->getCurrentFiscalyear();

            // Create Fee Record
            $fee = Fee::create($validatedRequest);

            // Create Fee Item
            $feeItem = $fee->fee_items()->create([
                'fee_head_id' => 1,
                'quantity' => $validatedRequest['quantity'],
                'amount' => $rider->monthly_charge,
                'total_amount' => $validatedRequest['total_amount'],
            ]);

            // Insert FeeItemMonths
            $feeItemMonthsData = [];
            foreach ($validatedRequest['months'] as $month) {
                $feeItemMonthsData[] = [
                    'fee_id' => $fee->id,
                    'rider_id' => $rider->id,
                    'fee_item_id' => $feeItem->id,
                    'month_id' => $month,
                    'year' => $this->getCurrentFiscalyear(),
                    'amount' => $rider->monthly_charge,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            FeeItemMonth::insert($feeItemMonthsData); // Bulk insert for efficiency

            DB::commit(); // Commit transaction

            return FeeResource::make($fee->load($this->resourceLoader));
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction on error
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function getCurrentFiscalyear()
    {
        $fiscalYear = (int) UserInitialValue::query()
            ->where('user_id', auth()->user()->id)
            ->where('key', 'fiscalYearId')
            ->first()->value;
        return $fiscalYear;
    }

    private function getFeeNo()
    {
        $lastFee = Fee::latest('id')->first();
        if ($lastFee) {
            $lastFeeNo = $lastFee->fee_no;
            $lastNumber = (int) substr($lastFeeNo, -5);
            $newNumber = $lastNumber + 1;
            $newFeeNo = 'F' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
        } else {
            $newFeeNo = 'F00001';
        }
        return $newFeeNo;
        // return $newFeeNo;
    }

    public function update(UpdateFeeRequest $request, $id)
    {
        $response = Fee::find($id);
        $response->update($request->validated());

        return FeeResource::make($response);

    }

    public function delete($id)
    {

        Fee::find($id)->delete();

        return response()->noContent();

    }
}
