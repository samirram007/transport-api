<?php

namespace App\Services;

use App\Http\Requests\UserInitialValue\StoreUserInitialValueRequest;
use App\Http\Requests\UserInitialValue\UpdateUserInitialValueRequest;

interface IUserInitialValueService
{
    public function getAll();

    public function getById($id);

    public function store(StoreUserInitialValueRequest $request);

    public function update(UpdateUserInitialValueRequest $request, $id);

    public function delete($id);
}
