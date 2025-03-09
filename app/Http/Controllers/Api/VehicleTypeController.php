<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\VehicleType\StoreVehicleTypeRequest;
use App\Http\Requests\VehicleType\UpdateVehicleTypeRequest;
use App\Http\Resources\SuccessResource;
use App\Services\IVehicleTypeService;

class VehicleTypeController extends Controller
{
    protected $vehicleTypeService;

    public function __construct(IVehicleTypeService $vehicleTypeService)
    {
        $this->vehicleTypeService = $vehicleTypeService;
    }

    public function index()
    {
        $response = $this->vehicleTypeService->getAll();

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleTypeRequest $request): SuccessResource|array|null
    {
        $response = $this->vehicleTypeService->store($request);

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $response = $this->vehicleTypeService->getById($id);

        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleTypeRequest $request, $id)
    {
        $response = $this->vehicleTypeService->update($request, $id);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $response = $this->vehicleTypeService->delete($id);

        return $response;

    }
}
