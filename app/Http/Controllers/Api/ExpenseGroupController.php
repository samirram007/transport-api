<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseGroup\StoreExpenseGroupRequest;
use App\Http\Requests\ExpenseGroup\UpdateExpenseGroupRequest;
use App\Http\Resources\SuccessResource;
use App\Services\IExpenseGroupService;

class ExpenseGroupController extends Controller
{
    protected $expenseGroupService;

    public function __construct(IExpenseGroupService $expenseGroupService)
    {
        $this->expenseGroupService = $expenseGroupService;
    }

    public function index()
    {
        $response = $this->expenseGroupService->getAll();

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseGroupRequest $request): SuccessResource|array|null
    {
        $response = $this->expenseGroupService->store($request);

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $response = $this->expenseGroupService->getById($id);

        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseGroupRequest $request, $id)
    {
        $response = $this->expenseGroupService->update($request, $id);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $response = $this->expenseGroupService->delete($id);

        return $response;

    }
}
