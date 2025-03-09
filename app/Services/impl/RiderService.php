<?php

namespace App\Services\impl;

use App\Exceptions\ModelNotFoundException as ExceptionsModelNotFoundException;
use App\Http\Requests\Rider\StoreRiderRequest;
use App\Http\Requests\Rider\UpdateRiderRequest;
use App\Http\Resources\Fee\FeeCollection;
use App\Http\Resources\Rider\RiderCollection;
use App\Http\Resources\Rider\RiderResource;
use App\Models\Fee;
use App\Models\FiscalYear;
use App\Models\Rider;
use App\Models\RiderSnapshot;
use App\Models\UserInitialValue;
use App\Services\IRiderService;
use Exception;
use Illuminate\Support\Facades\DB;

class RiderService implements IRiderService
{
    protected $resourceLoader;

    public function __construct()
    {
        $this->resourceLoader = [
            'school',
            'vehicle',
            'pickup_slot',
            'drop_slot',
            'profile_document',
        ];
    }

    public function getAll()
    {


        $rider = Rider::with($this->resourceLoader)->get();

        return RiderCollection::make($rider);
    }


    public function getById($id)
    {

        try {
            $response = Rider::findOrFail($id);

            return RiderResource::make($response->load($this->resourceLoader));
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

    public function store(StoreRiderRequest $request)
    {
        DB::beginTransaction();
        try {
            // Create a new rider
            $rider = Rider::create($request->validated());

            // Create a snapshot of the new rider
            $riderSnapshot = new RiderSnapshot();
            $riderSnapshot->fill($rider->toArray());
            $riderSnapshot->rider_id = $rider->id;
            $riderSnapshot->save();

            // Update the rider with the snapshot ID
            $rider->update(['rider_snapshot_id' => $riderSnapshot->id]);

            DB::commit();

            return RiderResource::make($rider);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function update(UpdateRiderRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $existingRider = Rider::findOrFail($id); // Ensure rider exists
            $validatedRequest = $request->validated();

            // Check if all validated fields are the same
            $isSame = true;
            foreach ($validatedRequest as $key => $value) {
                $existingValue = $existingRider->$key;

                // If field is an enum, get its value for comparison
                if ($existingValue instanceof \UnitEnum) {
                    // dump($existingValue);
                    $existingValue = $existingValue->value;
                }

                if ($existingValue != $value) {
                    // dump($existingValue);
                    $isSame = false;
                    break;
                }
            }
            // dd($isSame);
            // If data is unchanged, return existing rider without updating
            if ($isSame) {
                DB::commit();
                return RiderResource::make($existingRider);
            }

            // Create a snapshot of the existing data
            $riderSnapShot = new RiderSnapshot();
            // $riderSnapShot->fill($existingRider->toArray());
            $existingRider->fill($validatedRequest);
            $riderSnapShot->fill($existingRider->toArray());
            $riderSnapShot->rider_id = $id;
            $riderSnapShot->save();

            // Assign snapshot ID to request before updating the rider
            $validatedRequest['rider_snapshot_id'] = $riderSnapShot->id;

            // Update the rider
            $existingRider->update($validatedRequest);

            DB::commit();

            return RiderResource::make($existingRider);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function delete($id)
    {

        Rider::find($id)->delete();

        return response()->noContent();

    }

    public function searchRidersForFees()
    {

        $message = [];

        $request = request();
        // dd($request);
        if (!$request->has('text') || $request->input('text') == '') {

            array_push($message, 'Please provide search text');
            return response()->json(
                [
                    'status' => false,
                    'message' => $message,
                ]
                ,
                400
            );
        } elseif ($request->has('text')) {
            $currentFiscalyear = FiscalYear::where('is_current', 1)->first();
            $selectedFiscalyear = UserInitialValue::where('user_id', auth()->user()->id)
                ->whereIn('key', ['current_fiscal_year', 'fiscalYearId', 'fiscal_year_id', 'selectedFiscalYear'])
                ->first()->value;

            if (!$selectedFiscalyear) {
                $selectedFiscalyear = $currentFiscalyear->name;
            }


            $selectedFiscalYear = FiscalYear::where('name', $selectedFiscalyear)->first();

            $resourceLoaderForFees = [
                'school',
                'vehicle.vehicle_type',
                'pickup_slot',
                'drop_slot',
                'profile_document',
                'fee_item_months',
                'fees' => function ($query) use ($selectedFiscalYear) {
                    $query->where('is_deleted', 0)
                        ->where('fiscal_year_id', $selectedFiscalYear->id)
                        ->with([
                            'fiscal_year',
                            'fee_items.fee_item_months',
                            'fee_item_months',
                            'rider_snapshot.school',
                            'rider_snapshot.vehicle.vehicle_type'
                        ]);
                }
            ];
            $rider =  Rider::first();
            dd($rider->feeItemMonths->toArray() ?? []);

            $rider = Rider::with($resourceLoaderForFees)
                ->where('name', 'like', '%' . $request->input('text') . '%')
                ->get();
dd($rider->toArray() ?? []);
            return RiderCollection::make($rider);
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
}
