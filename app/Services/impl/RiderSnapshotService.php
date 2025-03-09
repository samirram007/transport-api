<?php

namespace App\Services\impl;

use App\Exceptions\ModelNotFoundException as ExceptionsModelNotFoundException;
use App\Http\Requests\Rider\StoreRiderRequest;
use App\Http\Requests\Rider\UpdateRiderRequest;
use App\Http\Resources\Fee\FeeCollection;
use App\Http\Resources\Rider\RiderCollection;
use App\Http\Resources\Rider\RiderResource;
use App\Http\Resources\RiderSnapshot\RiderSnapshotCollection;
use App\Http\Resources\RiderSnapshot\RiderSnapshotResource;
use App\Models\Fee;
use App\Models\FiscalYear;
use App\Models\Rider;
use App\Models\RiderSnapshot;
use App\Models\UserInitialValue;
use App\Services\IRiderService;
use App\Services\IRiderSnapShotService;
use Exception;

class RiderSnapShotService implements IRiderSnapShotService
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
            'user'
        ];
    }

    public function getAll()
    {


        $rider = RiderSnapshot::with($this->resourceLoader)->get();

        return RiderSnapshotCollection::make($rider);
    }


    public function getById($id)
    {

        try {
            $response = RiderSnapshot::findOrFail($id);

            return RiderSnapshotResource::make($response->load($this->resourceLoader));
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
        $response = RiderSnapshot::create($request->validated());

        return RiderSnapshotResource::make($response);
    }

    public function update(UpdateRiderRequest $request, $id)
    {
        $response = RiderSnapshot::find($id);
        $response->update($request->validated());

        return RiderSnapshotResource::make($response);

    }

    public function delete($id)
    {

        RiderSnapshot::find($id)->delete();

        return response()->noContent();

    }


}
