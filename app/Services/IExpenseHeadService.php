<?php

namespace App\Services;

use App\Http\Requests\ExpenseHead\StoreExpenseHeadRequest;
use App\Http\Requests\ExpenseHead\UpdateExpenseHeadRequest;

interface IExpenseHeadService
{
    public function getAll();

    public function getById($id);

    public function store(StoreExpenseHeadRequest $request);

    public function update(UpdateExpenseHeadRequest $request, $id);

    public function delete($id);
}
