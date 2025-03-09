<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\Rider\StoreRiderRequest;
use App\Http\Requests\Rider\UpdateRiderRequest;
use App\Http\Resources\SuccessResource;
use App\Services\IRiderService;

class RiderController extends Controller
{
    protected $riderService;

    public function __construct(IRiderService $riderService)
    {
        $this->riderService = $riderService;
    }

    public function index()
    {
        $response = $this->riderService->getAll();

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRiderRequest $request): SuccessResource|array|null
    {
        $response = $this->riderService->store($request);

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $response = $this->riderService->getById($id);

        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRiderRequest $request, $id)
    {
        $response = $this->riderService->update($request, $id);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $response = $this->riderService->delete($id);

        return $response;

    }
    public function searchRidersForFees()    {
        $response = $this->riderService->searchRidersForFees();

        return $response;

    }
}
