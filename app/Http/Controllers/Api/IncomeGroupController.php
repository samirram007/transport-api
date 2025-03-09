<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IncomeGroup\StoreIncomeGroupRequest;
use App\Http\Requests\IncomeGroup\UpdateIncomeGroupRequest;
use App\Http\Resources\SuccessResource;
use App\Services\IIncomeGroupService;

class IncomeGroupController extends Controller
{
    protected $incomeGroupService;

    public function __construct(IIncomeGroupService $incomeGroupService)
    {
        $this->incomeGroupService = $incomeGroupService;
    }

    public function index()
    {
        $response = $this->incomeGroupService->getAll();

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIncomeGroupRequest $request): SuccessResource|array|null
    {
        $response = $this->incomeGroupService->store($request);

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $response = $this->incomeGroupService->getById($id);

        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIncomeGroupRequest $request, $id)
    {
        $response = $this->incomeGroupService->update($request, $id);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $response = $this->incomeGroupService->delete($id);

        return $response;

    }
}
