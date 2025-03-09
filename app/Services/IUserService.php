<?php

namespace App\Services;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

interface IUserService
{
    public function getAll();

    public function getById(int $id);

    public function store(StoreUserRequest $request);

    public function update(UpdateUserRequest $request, int $id);

    public function delete(int $id);

    public function profile();
}
