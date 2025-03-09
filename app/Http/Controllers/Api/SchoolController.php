<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\School\StoreSchoolRequest;
use App\Http\Requests\School\UpdateSchoolRequest;
use App\Http\Resources\SuccessResource;
use App\Services\ISchoolService;

class SchoolController extends Controller
{
    protected $schoolService;

    public function __construct(ISchoolService $schoolService)
    {
        $this->schoolService = $schoolService;
    }

    public function index()
    {
        $response = $this->schoolService->getAll();

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSchoolRequest $request): SuccessResource|array|null
    {
        $response = $this->schoolService->store($request);

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $response = $this->schoolService->getById($id);

        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSchoolRequest $request, $id)
    {
        $response = $this->schoolService->update($request, $id);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $response = $this->schoolService->delete($id);

        return $response;

    }
}
