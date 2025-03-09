<?php

namespace App\Services\impl;

use App\Exceptions\ModelNotFoundException as ExceptionsModelNotFoundException;
use App\Http\Requests\School\StoreSchoolRequest;
use App\Http\Requests\School\UpdateSchoolRequest;
use App\Http\Resources\School\SchoolCollection;
use App\Http\Resources\School\SchoolResource;
use App\Models\School;
use App\Services\ISchoolService;
use Exception;

class SchoolService implements ISchoolService
{
    protected $resourceLoader;

    public function __construct()
    {
        $this->resourceLoader = [
            'address',
            'logo_image'
        ];
    }

    public function getAll()
    {
        $school = School::with($this->resourceLoader)->get();

        return SchoolCollection::make($school);
    }

    public function getById($id)
    {

        try {
            $response = School::findOrFail($id);

            return SchoolResource::make($response->load($this->resourceLoader));
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

    public function store(StoreSchoolRequest $request)
    {
        $response = School::create($request->validated());

        return SchoolResource::make($response);
    }

    public function update(UpdateSchoolRequest $request, $id)
    {
        $response = School::find($id);
        $response->update($request->validated());

        return SchoolResource::make($response);

    }

    public function delete($id)
    {

        School::find($id)->delete();

        return response()->noContent();

    }
}