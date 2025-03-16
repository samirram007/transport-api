<?php

namespace App\Services\impl;

use App\Exceptions\ModelNotFoundException as ExceptionsModelNotFoundException;
use App\Http\Requests\Expense\StoreExpenseRequest;
use App\Http\Requests\Expense\UpdateExpenseRequest;
use App\Http\Resources\Expense\ExpenseCollection;
use App\Http\Resources\Expense\ExpenseResource;
use App\Models\Expense;
use App\Models\ExpenseItem;
use App\Models\FiscalYear;
use App\Models\Rider;
use App\Models\UserInitialValue;
use App\Services\IExpenseService;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ExpenseService implements IExpenseService
{
    protected $resourceLoader;

    public function __construct()
    {
        $this->resourceLoader = [
            'expense_items.expense_head',
        ];
    }

    public function getAll()
    {

        $message = [];

        $request = request();
        // dd($request);
        if (!$request->has('fiscal_year_id')) {

            array_push($message, 'Please provide Fiscal year');
            return response()->json(
                [
                    'status' => false,
                    'message' => $message,
                ]
                ,
                400
            );
        } elseif ($request->has('from') && $request->has('to')) {



            $expense = Expense::with($this->resourceLoader)
                ->whereBetween('expense_date', [$request->input('from'), $request->input('to')])
                ->get();
            //dd($expense->toArray());
            return ExpenseCollection::make($expense);
        } else {
            array_push($message, 'Date range is required');
            return response()->json(
                [
                    'status' => false,
                    'message' => $message,
                ]
                ,
                400
            );
        }

    }

    public function getById($id)
    {

        try {
            $response = Expense::findOrFail($id);

            return ExpenseResource::make($response->load($this->resourceLoader));
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



    public function store(StoreExpenseRequest $request)
    {
        try {
            // Start database transaction
            DB::beginTransaction();
            
            // Get validated data from request
            $validated = $request->validated();
            
            // Generate new expense number
            $expenseNo = $this->getExpenseNo();
            
            // Get current fiscal year if not provided
            $fiscalYearId = $validated['fiscal_year_id'] ?? $this->getCurrentFiscalyear();
            
            // Check if fiscal year exists
            $fiscalYear = FiscalYear::findOrFail($fiscalYearId);
            
            // Create the expense record
            $expense = new Expense();
            $expense->expense_no = $expenseNo;
            $expense->expense_date = $validated['expense_date'];
            $expense->fiscal_year_id = $fiscalYearId;
            $expense->total_amount = $validated['total_amount'];
            $expense->payment_mode = $validated['payment_mode'] ?? null;
            $expense->note = $validated['note'] ?? null;
            $expense->document_id = $validated['document_id'] ?? null;
            $expense->voucher_no = $validated['voucher_no'] ?? null;
            $expense->account_id = $validated['account_id'] ?? null;
            $expense->save();
            
            // Create expense items if provided
            if (isset($validated['expense_items']) && is_array($validated['expense_items'])) {
                $itemTotal = 0;
                
                foreach ($validated['expense_items'] as $item) {
                    // Create expense item
                    $expenseItem = new ExpenseItem();
                    $expenseItem->expense_id = $expense->id;
                    $expenseItem->expense_head_id = $item['expense_head_id'];
                    $expenseItem->amount = $item['amount'];
                    $expenseItem->save();
                    
                    $itemTotal += floatval($item['amount']);
                }
                
                // Validate that item total matches the expense total
                if (abs($itemTotal - floatval($expense->total_amount)) > 0.01) {
                    throw new ValidationException(validator([], ['total' => 'The expense items total does not match the expense total amount']));
                }
            }
            
            // Commit transaction
            DB::commit();
            
            // Return created expense with loaded relationships
            return response()->json([
                'status' => true,
                'message' => 'Expense created successfully',
                'data' => new ExpenseResource($expense->load($this->resourceLoader))
            ], 201);
            
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::error('Validation error while creating expense: ' . $e->getMessage());
            
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'errors' => $e->errors()
            ], 422);
            
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            Log::error('Model not found while creating expense: ' . $e->getMessage());
            
            return response()->json([
                'status' => false,
                'message' => 'Related record not found.',
                'error' => $e->getMessage()
            ], 404);
            
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating expense: ' . $e->getMessage());
            
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while creating the expense',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getCurrentFiscalyear()
    {
        $fiscalYear = (int) UserInitialValue::query()
            ->where('user_id', auth()->user()->id)
            ->where('key', 'fiscalYearId')
            ->first()->value;
        return $fiscalYear;
    }

    private function getExpenseNo()
    {
        $lastExpense = Expense::latest('id')->first();
        if ($lastExpense) {
            $lastExpenseNo = $lastExpense->expense_no;
            $lastNumber = (int) substr($lastExpenseNo, -5);
            $newNumber = $lastNumber + 1;
            $newExpenseNo = 'F' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
        } else {
            $newExpenseNo = 'F00001';
        }
        return $newExpenseNo;
        // return $newExpenseNo;
    }

    public function update(UpdateExpenseRequest $request, $id)
    {
        $response = Expense::find($id);
        $response->update($request->validated());

        return ExpenseResource::make($response);

    }

    public function delete($id)
    {

        Expense::find($id)->delete();

        return response()->noContent();

    }
}
