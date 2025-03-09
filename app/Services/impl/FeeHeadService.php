<?php

namespace App\Services\impl;

use App\Exceptions\ModelNotFoundException as ExceptionsModelNotFoundException;
use App\Http\Requests\FeeHead\StoreFeeHeadRequest;
use App\Http\Requests\FeeHead\UpdateFeeHeadRequest;
use App\Http\Resources\FeeHead\FeeHeadCollection;
use App\Http\Resources\FeeHead\FeeHeadResource;
use App\Models\FeeHead;
use App\Services\IFeeHeadService;
use Exception;
use Illuminate\Database\RecordsNotFoundException;

class FeeHeadService implements IFeeHeadService
{
    protected $resourceLoader=[];
    public function getAll()
    {
        $feeHead = FeeHead::with($this->resourceLoader)->get();

        return FeeHeadCollection::make($feeHead);
    }

    public function getById($id)
    {

        try {
            $response = FeeHead::findOrFail($id);

            return FeeHeadResource::make($response->load($this->resourceLoader));
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

    public function store(StoreFeeHeadRequest $request)
    {
        $response = FeeHead::create($request->validated());

        return FeeHeadResource::make($response);
    }

    public function update(UpdateFeeHeadRequest $request, $id)
    {
        $response = FeeHead::find($id);
        $response->update($request->validated());

        return FeeHeadResource::make($response);

    }

    public function delete($id)
    {

        FeeHead::find($id)->delete();

        return response()->noContent();

    }
}
