<?php

namespace App\Services\impl;

use App\Exceptions\ModelNotFoundException as ExceptionsModelNotFoundException;
use App\Http\Requests\FiscalYear\StoreFiscalYearRequest;
use App\Http\Requests\FiscalYear\UpdateFiscalYearRequest;
use App\Http\Resources\FiscalYear\FiscalYearCollection;
use App\Http\Resources\FiscalYear\FiscalYearResource;
use App\Models\FiscalYear;
use App\Models\Fee;
use App\Models\FeeTemplate;
use App\Models\StudentSession;
use App\Models\User;
use App\Services\IFiscalYearService;
use Exception;
use Illuminate\Database\RecordsNotFoundException;

class FiscalYearService implements IFiscalYearService
{
    protected $resourceLoader = ['previous_fiscal_year', 'next_fiscal_year'];
    public function getAll()
    {
        $fiscalYear = FiscalYear::with($this->resourceLoader)
            ->orderBy('id', 'desc')
            ->get();

        return FiscalYearCollection::make($fiscalYear);
    }

    public function getById($id)
    {

        try {
            $response = FiscalYear::findOrFail($id);

            return FiscalYearResource::make($response->load($this->resourceLoader));
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

    public function store(StoreFiscalYearRequest $request)
    {
        $response = FiscalYear::create($request->validated());

        return FiscalYearResource::make($response);
    }

    public function update(UpdateFiscalYearRequest $request, $id)
    {
        try {
            $fiscalYear = FiscalYear::find($id);
            $fiscalYear->update($request->validated());

            $result = \DB::transaction(function () use ($request, $fiscalYear) {
                $data = $request->validated();
                if ($data['campus_id'] == $fiscalYear->campus_id) {
                    $fiscalYear->update($data);
                    return $fiscalYear;
                }
                $student_sessions = StudentSession::where('academic_class_id', $fiscalYear->id)->get();
                $student_sessions->each->update(['campus_id' => $data['campus_id']]);

                $fees = Fee::where('academic_class_id', $fiscalYear->id)->get();
                $fees->each->update(['campus_id' => $data['campus_id']]);

                $users = User::where('academic_class_id', $fiscalYear->id)->get();
                $users->each->update(['campus_id' => $data['campus_id']]);

                $fee_templates = FeeTemplate::where('academic_class_id', $fiscalYear->id)->get();
                $fee_templates->each->update(['campus_id' => $data['campus_id']]);

                $fiscalYear->update($data);
                return $fiscalYear;

            });

            return new FiscalYearResource($result);

        } catch (Exception $e) {
            // If any exception occurs, transaction will be rolled back
            return response()->json([
                'success' => false,
                'message' => 'Error occurred: ' . $e->getMessage(),
            ], 500);
        }


    }

    public function delete($id)
    {

        FiscalYear::find($id)->delete();

        return response()->noContent();

    }
}
