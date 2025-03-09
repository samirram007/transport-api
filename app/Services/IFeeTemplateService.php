<?php

namespace App\Services;

use App\Http\Requests\FeeTemplate\StoreFeeTemplateRequest;
use App\Http\Requests\FeeTemplate\UpdateFeeTemplateRequest;

interface IFeeTemplateService
{
    public function getAll();

    public function getById($id);

    public function store(StoreFeeTemplateRequest $request);

    public function update(UpdateFeeTemplateRequest $request, $id);

    public function delete($id);
}
