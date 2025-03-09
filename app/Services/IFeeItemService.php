<?php

namespace App\Services;

use App\Http\Requests\FeeItem\StoreFeeItemRequest;
use App\Http\Requests\FeeItem\UpdateFeeItemRequest;

interface IFeeItemService
{
    public function getAll();

    public function getById($id);

    public function store(StoreFeeItemRequest $request);

    public function update(UpdateFeeItemRequest $request, $id);

    public function delete($id);
}
