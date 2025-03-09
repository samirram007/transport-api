<?php

namespace App\Services;

use App\Http\Requests\FiscalYear\StoreFiscalYearRequest;
use App\Http\Requests\FiscalYear\UpdateFiscalYearRequest;

interface IFiscalYearService
{
    public function getAll();

    public function getById($id);

    public function store(StoreFiscalYearRequest $request);

    public function update(UpdateFiscalYearRequest $request, $id);

    public function delete($id);
}