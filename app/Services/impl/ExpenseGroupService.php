<?php

namespace App\Services\impl;

use App\Exceptions\ModelNotFoundException as ExceptionsModelNotFoundException;
use App\Http\Requests\ExpenseGroup\StoreExpenseGroupRequest;
use App\Http\Requests\ExpenseGroup\UpdateExpenseGroupRequest;
use App\Http\Resources\ExpenseGroup\ExpenseGroupCollection;
use App\Http\Resources\ExpenseGroup\ExpenseGroupResource;
use App\Models\ExpenseGroup;
use App\Services\IExpenseGroupService;
use Exception;
use Illuminate\Database\RecordsNotFoundException;

class ExpenseGroupService implements IExpenseGroupService
{
    protected $resourceLoader=[];
    public function getAll()
    {
        $expenseGroup = ExpenseGroup::with($this->resourceLoader)->get();

        return ExpenseGroupCollection::make($expenseGroup);
    }

    public function getById($id)
    {

        try {
            $response = ExpenseGroup::findOrFail($id);

            return ExpenseGroupResource::make($response->load($this->resourceLoader));
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

    public function store(StoreExpenseGroupRequest $request)
    {
        $response = ExpenseGroup::create($request->validated());

        return ExpenseGroupResource::make($response);
    }

    public function update(UpdateExpenseGroupRequest $request, $id)
    {
        $response = ExpenseGroup::find($id);
        $response->update($request->validated());

        return ExpenseGroupResource::make($response);

    }

    public function delete($id)
    {

        ExpenseGroup::find($id)->delete();

        return response()->noContent();

    }
}
