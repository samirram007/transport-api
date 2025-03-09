<?php

namespace App\Services;

use App\Http\Requests\ExpenseItem\StoreExpenseItemRequest;
use App\Http\Requests\ExpenseItem\UpdateExpenseItemRequest;

interface IExpenseItemService
{
    public function getAll();

    public function getById($id);

    public function store(StoreExpenseItemRequest $request);

    public function update(UpdateExpenseItemRequest $request, $id);

    public function delete($id);
}
