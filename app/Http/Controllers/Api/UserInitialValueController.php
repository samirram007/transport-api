<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserInitialValue\StoreUserInitialValueRequest;
use App\Http\Requests\UserInitialValue\UpdateUserInitialValueRequest;
use App\Models\UserInitialValue;
use App\Services\IUserInitialValueService;

class UserInitialValueController extends Controller
{
    protected $userInitialValueService;

    public function __construct(IUserInitialValueService $userInitialValueService)
    {
        $this->userInitialValueService = $userInitialValueService;
    }

    public function index()
    {

        $response = $this->userInitialValueService->getAll();

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserInitialValueRequest $request)
    {
        $response = $this->userInitialValueService->store($request);

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {

        $response = $this->userInitialValueService->getById($id);

        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserInitialValueRequest $request, int $id)
    {
        $response = $this->userInitialValueService->update($request, $id);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $response = $this->userInitialValueService->delete($id);

        return $response;
    }
}
