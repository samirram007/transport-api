<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeeHead\StoreFeeHeadRequest;
use App\Http\Requests\FeeHead\UpdateFeeHeadRequest;
use App\Http\Resources\SuccessResource;
use App\Services\IFeeHeadService;

class FeeHeadController extends Controller
{
    protected $feeHeadService;

    public function __construct(IFeeHeadService $feeHeadService)
    {
        $this->feeHeadService = $feeHeadService;
    }

    public function index()
    {
        $response = $this->feeHeadService->getAll();

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeeHeadRequest $request): SuccessResource|array|null
    {
        $response = $this->feeHeadService->store($request);

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $response = $this->feeHeadService->getById($id);

        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeeHeadRequest $request, $id)
    {
        $response = $this->feeHeadService->update($request, $id);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $response = $this->feeHeadService->delete($id);

        return $response;

    }
}
