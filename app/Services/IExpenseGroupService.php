<?php

namespace App\Services;

use App\Http\Requests\ExpenseGroup\StoreExpenseGroupRequest;
use App\Http\Requests\ExpenseGroup\UpdateExpenseGroupRequest;

interface IExpenseGroupService
{
    public function getAll();

    public function getById($id);

    public function store(StoreExpenseGroupRequest $request);

    public function update(UpdateExpenseGroupRequest $request, $id);

    public function delete($id);
}
