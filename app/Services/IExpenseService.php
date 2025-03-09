<?php

namespace App\Services;

use App\Http\Requests\Expense\StoreExpenseRequest;
use App\Http\Requests\Expense\UpdateExpenseRequest;

interface IExpenseService
{
    public function getAll();

    public function getById($id);

    public function store(StoreExpenseRequest $request);

    public function update(UpdateExpenseRequest $request, $id);

    public function delete($id);
}
