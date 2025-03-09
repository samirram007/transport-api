<?php

namespace App\Services\impl;

use App\Exceptions\ModelNotFoundException as ExceptionsModelNotFoundException;
use App\Http\Requests\Vehicle\StoreVehicleRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;
use App\Http\Resources\Vehicle\VehicleCollection;
use App\Http\Resources\Vehicle\VehicleResource;
use App\Models\Vehicle;
use App\Services\IVehicleService;
use Exception;

class VehicleService implements IVehicleService
{
    protected $resourceLoader;

    public function __construct()
    {
        $this->resourceLoader = [
            'vehicle_type',
        ];
    }

    public function getAll()
    {
        $vehicle = Vehicle::with($this->resourceLoader)->get();

        return VehicleCollection::make($vehicle);
    }

    public function getById($id)
    {

        try {
            $response = Vehicle::findOrFail($id);

            return VehicleResource::make($response->load($this->resourceLoader));
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

    public function store(StoreVehicleRequest $request)
    {
        $response = Vehicle::create($request->validated());

        return VehicleResource::make($response);
    }

    public function update(UpdateVehicleRequest $request, $id)
    {
        $response = Vehicle::find($id);
        $response->update($request->validated());

        return VehicleResource::make($response);

    }

    public function delete($id)
    {

        Vehicle::find($id)->delete();

        return response()->noContent();

    }
}
