<?php

namespace App\Services;

use App\Http\Requests\FeeHead\StoreFeeHeadRequest;
use App\Http\Requests\FeeHead\UpdateFeeHeadRequest;

interface IFeeHeadService
{
    public function getAll();

    public function getById($id);

    public function store(StoreFeeHeadRequest $request);

    public function update(UpdateFeeHeadRequest $request, $id);

    public function delete($id);
}
