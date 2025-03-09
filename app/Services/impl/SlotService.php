<?php

namespace App\Services\impl;

use App\Exceptions\ModelNotFoundException as ExceptionsModelNotFoundException;
use App\Http\Requests\Slot\StoreSlotRequest;
use App\Http\Requests\Slot\UpdateSlotRequest;
use App\Http\Resources\Slot\SlotCollection;
use App\Http\Resources\Slot\SlotResource;
use App\Models\Slot;
use App\Services\ISlotService;
use Exception;

class SlotService implements ISlotService
{
    protected $resourceLoader;

    public function __construct()
    {
        $this->resourceLoader = [
            'vehicle',
        ];
    }

    public function getAll()
    {
        $slot = Slot::with($this->resourceLoader)->get();

        return SlotCollection::make($slot);
    }

    public function getById($id)
    {

        try {
            $response = Slot::findOrFail($id);

            return SlotResource::make($response->load($this->resourceLoader));
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

    public function store(StoreSlotRequest $request)
    {


        $response = Slot::create($request->validated());

        return SlotResource::make($response);
    }

    public function update(UpdateSlotRequest $request, $id)
    {
        $response = Slot::find($id);
        $response->update($request->validated());

        return SlotResource::make($response);

    }

    public function delete($id)
    {

        Slot::find($id)->delete();

        return response()->noContent();

    }
}
