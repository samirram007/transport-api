<?php

namespace App\Services;

use App\Http\Requests\FeeItemMonth\StoreFeeItemMonthRequest;
use App\Http\Requests\FeeItemMonth\UpdateFeeItemMonthRequest;

interface IFeeItemMonthService
{
    public function getAll();

    public function getById($id);

    public function store(StoreFeeItemMonthRequest $request);

    public function update(UpdateFeeItemMonthRequest $request, $id);

    public function delete($id);
}
