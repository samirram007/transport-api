<?php

namespace App\Services\impl;

use App\Exceptions\ModelNotFoundException as ExceptionsModelNotFoundException;
use App\Http\Requests\ExpenseHead\StoreExpenseHeadRequest;
use App\Http\Requests\ExpenseHead\UpdateExpenseHeadRequest;
use App\Http\Resources\ExpenseHead\ExpenseHeadCollection;
use App\Http\Resources\ExpenseHead\ExpenseHeadResource;
use App\Models\ExpenseHead;
use App\Services\IExpenseHeadService;
use Exception;
use Illuminate\Database\RecordsNotFoundException;

class ExpenseHeadService implements IExpenseHeadService
{
    protected $resourceLoader=['expense_group'];
    public function getAll()
    {
        $expenseHead = ExpenseHead::with($this->resourceLoader)->get();

        return ExpenseHeadCollection::make($expenseHead);
    }

    public function getById($id)
    {

        try {
            $response = ExpenseHead::findOrFail($id);

            return ExpenseHeadResource::make($response->load($this->resourceLoader));
        } catch (Exception $e) {
            // Handle the case where the model is not found
            // throw new ExceptionsModelNotFoundException($e);
            // return new ExceptionsModelNotFoundException($e);
            return response()->json([
                'status' => false,
                'message' => 'Record not found.',
                'code' => 404,
            ], 404);
        }
    }

    public function store(StoreExpenseHeadRequest $request)
    {
        $response = ExpenseHead::create($request->validated());

        return ExpenseHeadResource::make($response);
    }

    public function update(UpdateExpenseHeadRequest $request, $id)
    {
        $response = ExpenseHead::find($id);
        $response->update($request->validated());

        return ExpenseHeadResource::make($response);

    }

    public function delete($id)
    {

        ExpenseHead::find($id)->delete();

        return response()->noContent();

    }
}
