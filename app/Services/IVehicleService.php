<?php

namespace App\Services;

use App\Http\Requests\Vehicle\StoreVehicleRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;

interface IVehicleService
{
    public function getAll();

    public function getById($id);

    public function store(StoreVehicleRequest $request);

    public function update(UpdateVehicleRequest $request, $id);

    public function delete($id);
}