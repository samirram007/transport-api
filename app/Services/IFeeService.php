<?php

namespace App\Services;

use App\Http\Requests\Fee\StoreFeeRequest;
use App\Http\Requests\Fee\UpdateFeeRequest;

interface IFeeService
{
    public function getAll();

    public function getById($id);

    public function store(StoreFeeRequest $request);

    public function update(UpdateFeeRequest $request, $id);

    public function delete($id);
}
