<?php

namespace App\Services\impl;

use App\Exceptions\ModelNotFoundException as ExceptionsModelNotFoundException;
use App\Http\Requests\Organization\StoreOrganizationRequest;
use App\Http\Requests\Organization\UpdateOrganizationRequest;
use App\Http\Resources\Organization\OrganizationCollection;
use App\Http\Resources\Organization\OrganizationResource;
use App\Models\Organization;
use App\Services\IOrganizationService;
use Exception;

class OrganizationService implements IOrganizationService
{
    protected $resourceLoader;

    public function __construct()
    {
        $this->resourceLoader = [
            'address',
            'logo_image',
        ];
    }

    public function getAll()
    {
        $organization = Organization::with($this->resourceLoader)->get();

        return OrganizationCollection::make($organization);
    }

    public function getById($id)
    {

        try {
            $response = Organization::findOrFail($id);

            return OrganizationResource::make($response->load($this->resourceLoader));
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

    public function store(StoreOrganizationRequest $request)
    {
        $response = Organization::create($request->validated());

        return OrganizationResource::make($response);
    }

    public function update(UpdateOrganizationRequest $request, $id)
    {
        $response = Organization::find($id);
        $response->update($request->validated());

        return OrganizationResource::make($response);

    }

    public function delete($id)
    {

        Organization::find($id)->delete();

        return response()->noContent();

    }
}
