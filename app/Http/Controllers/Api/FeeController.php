<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\Fee\StoreFeeRequest;
use App\Http\Requests\Fee\UpdateFeeRequest;
use App\Http\Resources\SuccessResource;
use App\Services\IFeeService;

class FeeController extends Controller
{
    protected $feeService;

    public function __construct(IFeeService $feeService)
    {
        $this->feeService = $feeService;
    }

    public function index()
    {
        $response = $this->feeService->getAll();

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeeRequest $request): SuccessResource|array|null
    {
        $response = $this->feeService->store($request);

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $response = $this->feeService->getById($id);

        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeeRequest $request, $id)
    {
        $response = $this->feeService->update($request, $id);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $response = $this->feeService->delete($id);

        return $response;

    }
}
