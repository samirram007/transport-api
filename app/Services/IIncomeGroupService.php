<?php

namespace App\Services;

use App\Http\Requests\IncomeGroup\StoreIncomeGroupRequest;
use App\Http\Requests\IncomeGroup\UpdateIncomeGroupRequest;

interface IIncomeGroupService
{
    public function getAll();

    public function getById($id);

    public function store(StoreIncomeGroupRequest $request);

    public function update(UpdateIncomeGroupRequest $request, $id);

    public function delete($id);
}
