<?php

namespace App\Services;

use App\Http\Requests\Organization\StoreOrganizationRequest;
use App\Http\Requests\Organization\UpdateOrganizationRequest;

interface IOrganizationService
{
    public function getAll();

    public function getById($id);

    public function store(StoreOrganizationRequest $request);

    public function update(UpdateOrganizationRequest $request, $id);

    public function delete($id);
}
