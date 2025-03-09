<?php

namespace App\Services\impl;

use App\Exceptions\ModelNotFoundException as ExceptionsModelNotFoundException;
use App\Http\Requests\IncomeGroup\StoreIncomeGroupRequest;
use App\Http\Requests\IncomeGroup\UpdateIncomeGroupRequest;
use App\Http\Resources\IncomeGroup\IncomeGroupCollection;
use App\Http\Resources\IncomeGroup\IncomeGroupResource;
use App\Models\IncomeGroup;
use App\Services\IIncomeGroupService;
use Exception;
use Illuminate\Database\RecordsNotFoundException;

class IncomeGroupService implements IIncomeGroupService
{
    protected $resourceLoader=[];
    public function getAll()
    {
        $incomeGroup = IncomeGroup::with($this->resourceLoader)->get();

        return IncomeGroupCollection::make($incomeGroup);
    }

    public function getById($id)
    {

        try {
            $response = IncomeGroup::findOrFail($id);

            return IncomeGroupResource::make($response->load($this->resourceLoader));
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

    public function store(StoreIncomeGroupRequest $request)
    {
        $response = IncomeGroup::create($request->validated());

        return IncomeGroupResource::make($response);
    }

    public function update(UpdateIncomeGroupRequest $request, $id)
    {
        $response = IncomeGroup::find($id);
        $response->update($request->validated());

        return IncomeGroupResource::make($response);

    }

    public function delete($id)
    {

        IncomeGroup::find($id)->delete();

        return response()->noContent();

    }
}
