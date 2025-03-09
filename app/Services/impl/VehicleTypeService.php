<?php

namespace App\Services\impl;

use App\Exceptions\ModelNotFoundException as ExceptionsModelNotFoundException;
use App\Http\Requests\VehicleType\StoreVehicleTypeRequest;
use App\Http\Requests\VehicleType\UpdateVehicleTypeRequest;
use App\Http\Resources\VehicleType\VehicleTypeCollection;
use App\Http\Resources\VehicleType\VehicleTypeResource;
use App\Models\VehicleType;
use App\Services\IVehicleTypeService;
use Exception;

class VehicleTypeService implements IVehicleTypeService
{
    protected $resourceLoader;

    public function __construct()
    {
        $this->resourceLoader = [
        ];
    }

    public function getAll()
    {
        $vehicleType = VehicleType::with($this->resourceLoader)->get();

        return VehicleTypeCollection::make($vehicleType);
    }

    public function getById($id)
    {

        try {
            $response = VehicleType::findOrFail($id);

            return VehicleTypeResource::make($response->load($this->resourceLoader));
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

    public function store(StoreVehicleTypeRequest $request)
    {
        $response = VehicleType::create($request->validated());

        return VehicleTypeResource::make($response);
    }

    public function update(UpdateVehicleTypeRequest $request, $id)
    {
        $response = VehicleType::find($id);
        $response->update($request->validated());

        return VehicleTypeResource::make($response);

    }

    public function delete($id)
    {

        VehicleType::find($id)->delete();

        return response()->noContent();

    }
}
