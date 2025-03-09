<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\Slot\StoreSlotRequest;
use App\Http\Requests\Slot\UpdateSlotRequest;
use App\Http\Resources\SuccessResource;
use App\Services\ISlotService;

class SlotController extends Controller
{
    protected $slotService;

    public function __construct(ISlotService $slotService)
    {
        $this->slotService = $slotService;
    }

    public function index()
    {
        $response = $this->slotService->getAll();

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSlotRequest $request): SuccessResource|array|null

    {

        $response = $this->slotService->store($request);

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $response = $this->slotService->getById($id);

        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSlotRequest $request, $id)
    {
        $response = $this->slotService->update($request, $id);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $response = $this->slotService->delete($id);

        return $response;

    }
}
