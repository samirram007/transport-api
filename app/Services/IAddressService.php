<?php

namespace App\Services;

use App\Http\Requests\Address\StoreAddressRequest;
use App\Http\Requests\Address\UpdateAddressRequest;

interface IAddressService
{
    public function getAll();

    public function getById($id);

    public function store(StoreAddressRequest $request);

    public function update(UpdateAddressRequest $request, $id);

    public function delete($id);
}
