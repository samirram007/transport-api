<?php

use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\EnumController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\ExpenseGroupController;
use App\Http\Controllers\Api\ExpenseHeadController;
use App\Http\Controllers\Api\FeeController;
use App\Http\Controllers\Api\FeeHeadController;
use App\Http\Controllers\Api\FeeTemplateController;
use App\Http\Controllers\Api\FeeTemplateItemController;
use App\Http\Controllers\Api\FiscalYearController;
use App\Http\Controllers\Api\IncomeGroupController;
use App\Http\Controllers\Api\MonthController;
use App\Http\Controllers\Api\RiderController;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\SlotController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserInitialValueController;
use App\Http\Controllers\Api\VehicleController;
use App\Http\Controllers\Api\VehicleTypeController;
use App\Http\Controllers\AuthController;
use App\Models\FiscalYear;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::controller(AuthController::class)
    ->middleware('api')
    ->prefix('auth')
    ->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
    });
Route::post('reload', function () {
    Artisan::call('migrate:refresh --seed');
});
Route::middleware('auth:api')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::apiResource('fiscal_years', FiscalYearController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('riders', RiderController::class);
    Route::get('search_riders_for_fees',[RiderController::class,'searchRidersForFees']);
    Route::apiResource('fees', FeeController::class);
    Route::apiResource('income_groups', IncomeGroupController::class);
    Route::apiResource('fee_heads', FeeHeadController::class);
    Route::apiResource('fee_templates', FeeTemplateController::class);
    Route::post('fee_templates/clone/{id}', [FeeTemplateController::class,'clone']);
    Route::apiResource('fee_template_items', FeeTemplateItemController::class);
    Route::apiResource('fees', FeeController::class);
    Route::put('fees/soft_delete/{id}', [FeeController::class,'softDelete']);
    Route::get('fees_by_student_session/{student_session}',[ FeeController::class,'FeesByStudentSession']);


    Route::apiResource('expenses', ExpenseController::class);
    Route::apiResource('expense_groups', ExpenseGroupController::class);
    Route::apiResource('expense_heads', ExpenseHeadController::class);
    Route::apiResource('user_initial_values', UserInitialValueController::class);
    Route::get('profile', [AuthController::class, 'profile']);
    Route::get('auth/profile', [AuthController::class, 'profile']);
    Route::apiResource('schools', SchoolController::class);
    Route::apiResource('vehicle_types', VehicleTypeController::class);
    Route::apiResource('vehicles', VehicleController::class);
    Route::apiResource('slots', SlotController::class);

});
Route::get('/months', [MonthController::class, 'index']);
// Route::apiResource('fee_items', FeeItemController::class);
// Route::apiResource('fee_item_months', FeeItemMonthController::class);
Route::get('/address_type', [EnumController::class, 'address_type']);
Route::get('/gender', [EnumController::class, 'gender']);
Route::get('/nationality', [EnumController::class, 'nationality']);
Route::get('/language', [EnumController::class, 'language']);
Route::get('/religion', [EnumController::class, 'religion']);
Route::get('/caste', [EnumController::class, 'caste']);
Route::get('/guardian_type', [EnumController::class, 'guardian_type']);
Route::get('/subject_type', [EnumController::class, 'subject_type']);
Route::get('/room_type', [EnumController::class, 'room_type']);
Route::get('/user_status', [EnumController::class, 'user_status']);
Route::get('/user_type', [EnumController::class, 'user_type']);
Route::get('/slot_type', [EnumController::class, 'slot_type']);
Route::get('/rider_type', [EnumController::class, 'rider_type']);
Route::get('/standard', [EnumController::class, 'standard']);
Route::get('/section', [EnumController::class, 'section']);
Route::get('/school_time', [EnumController::class, 'school_time']);


