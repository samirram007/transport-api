<?php

namespace App\Services\impl;

use App\Exceptions\ModelNotFoundException as ExceptionsModelNotFoundException;
use App\Http\Requests\Fee\StoreFeeRequest;
use App\Http\Requests\Fee\UpdateFeeRequest;
use App\Http\Resources\Fee\FeeCollection;
use App\Http\Resources\Fee\FeeResource;
use App\Models\Fee;
use App\Services\IFeeService;
use Exception;

class FeeService implements IFeeService
{
    protected $resourceLoader;

    public function __construct()
    {
        $this->resourceLoader = [
            'fee_items.fee_item_months',
            'fee_item_months',
            'rider'=> [
                'school',
                'vehicle.vehicle_type',
            ],
            'rider_snapshot'=> [
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
            ->whereBetween('fee_date',[$request->input('from'),$request->input('to')])
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
        $response = Fee::create($request->validated());

        return FeeResource::make($response);
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
