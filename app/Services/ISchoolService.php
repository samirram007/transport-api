<?php

namespace App\Services;

use App\Http\Requests\School\StoreSchoolRequest;
use App\Http\Requests\School\UpdateSchoolRequest;

interface ISchoolService
{
    public function getAll();

    public function getById($id);

    public function store(StoreSchoolRequest $request);

    public function update(UpdateSchoolRequest $request, $id);

    public function delete($id);
}
