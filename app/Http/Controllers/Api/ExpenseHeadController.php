<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseHead\StoreExpenseHeadRequest;
use App\Http\Requests\ExpenseHead\UpdateExpenseHeadRequest;
use App\Http\Resources\SuccessResource;
use App\Services\IExpenseHeadService;

class ExpenseHeadController extends Controller
{
    protected $expenseHeadService;

    public function __construct(IExpenseHeadService $expenseHeadService)
    {
        $this->expenseHeadService = $expenseHeadService;
    }

    public function index()
    {
        $response = $this->expenseHeadService->getAll();

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseHeadRequest $request): SuccessResource|array|null
    {
        $response = $this->expenseHeadService->store($request);

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $response = $this->expenseHeadService->getById($id);

        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseHeadRequest $request, $id)
    {
        $response = $this->expenseHeadService->update($request, $id);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $response = $this->expenseHeadService->delete($id);

        return $response;

    }
}
