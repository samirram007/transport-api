<?php

namespace App\Services;

use App\Http\Requests\VehicleType\StoreVehicleTypeRequest;
use App\Http\Requests\VehicleType\UpdateVehicleTypeRequest;

interface IVehicleTypeService
{
    public function getAll();

    public function getById($id);

    public function store(StoreVehicleTypeRequest $request);

    public function update(UpdateVehicleTypeRequest $request, $id);

    public function delete($id);
}
