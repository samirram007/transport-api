<?php

namespace App\Services;

use App\Http\Requests\Rider\StoreRiderRequest;
use App\Http\Requests\Rider\UpdateRiderRequest;

interface IRiderSnapShotService
{
    public function getAll();

    public function getById($id);

    public function store(StoreRiderRequest $request);

    public function update(UpdateRiderRequest $request, $id);

    public function delete($id);
}
