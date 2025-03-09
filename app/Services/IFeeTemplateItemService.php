<?php

namespace App\Services;

use App\Http\Requests\FeeTemplateItem\StoreFeeTemplateItemRequest;
use App\Http\Requests\FeeTemplateItem\UpdateFeeTemplateItemRequest;

interface IFeeTemplateItemService
{
    public function getAll();

    public function getById($id);

    public function store(StoreFeeTemplateItemRequest $request);

    public function update(UpdateFeeTemplateItemRequest $request, $id);

    public function delete($id);
}
