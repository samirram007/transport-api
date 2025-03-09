<?php

namespace App\Services;

use App\Http\Requests\Slot\StoreSlotRequest;
use App\Http\Requests\Slot\UpdateSlotRequest;

interface ISlotService
{
    public function getAll();

    public function getById($id);

    public function store(StoreSlotRequest $request);

    public function update(UpdateSlotRequest $request, $id);

    public function delete($id);
}
