<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//login
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

// Logout
Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');

//roles
Route::apiResource('/roles', App\Http\Controllers\Api\RoleController::class)->middleware('auth:sanctum');

//departments
Route::apiResource('/departments', App\Http\Controllers\Api\DepartmentController::class)->middleware('auth:sanctum');

//designations
Route::apiResource('/designations', App\Http\Controllers\Api\DesignationController::class)->middleware('auth:sanctum');

//shifts
Route::apiResource('/shifts', App\Http\Controllers\Api\ShiftController::class)->middleware('auth:sanctum');

//basic salaries
Route::apiResource('/basic-salaries', App\Http\Controllers\Api\BasicSalaryController::class)->middleware('auth:sanctum');

//holidays
Route::apiResource('/holidays', App\Http\Controllers\Api\HolidayController::class)->middleware('auth:sanctum');

// LeaveType
Route::apiResource('/leave-types', App\Http\Controllers\Api\LeaveTypeController::class)->middleware('auth:sanctum');

// Leaves
Route::apiResource('/leaves', App\Http\Controllers\Api\LeaveController::class)->middleware('auth:sanctum');

//attendances
Route::apiResource('/attendances', App\Http\Controllers\Api\AttendanceController::class)->middleware('auth:sanctum');

//payrolls
Route::apiResource('/payrolls', App\Http\Controllers\Api\PayrollController::class)->middleware('auth:sanctum');

//staffs
Route::get('/staffs', [App\Http\Controllers\Api\StaffController::class, 'index'])->middleware('auth:sanctum');
Route::post('/staffs', [App\Http\Controllers\Api\StaffController::class, 'store'])->middleware('auth:sanctum');
Route::post('/staffs/{id}', [App\Http\Controllers\Api\StaffController::class, 'update'])->middleware('auth:sanctum');
//delete
Route::delete('/staffs/{id}', [App\Http\Controllers\Api\StaffController::class, 'destroy'])->middleware('auth:sanctum');

//get company
Route::get('/company', [App\Http\Controllers\Api\CompanyController::class, 'showCompany'])->middleware('auth:sanctum');
//edit company
Route::put('/company', [App\Http\Controllers\Api\CompanyController::class, 'editCompany'])->middleware('auth:sanctum');

// categories
Route::apiResource('/categories', App\Http\Controllers\Api\Inventory\CategoryController::class)->middleware('auth:sanctum');
Route::apiResource('/brands', App\Http\Controllers\Api\Inventory\BrandController::class)->middleware('auth:sanctum');
Route::apiResource('/units', App\Http\Controllers\Api\Inventory\UnitController::class)->middleware('auth:sanctum');
Route::apiResource('/warehouses', App\Http\Controllers\Api\Inventory\WarehouseController::class)->middleware('auth:sanctum');
Route::apiResource('/suppliers', App\Http\Controllers\Api\Inventory\SupplierController::class)->middleware('auth:sanctum');
Route::apiResource('/products', App\Http\Controllers\Api\Inventory\ProductController::class)->middleware('auth:sanctum');

Route::post('/products/{id}', [App\Http\Controllers\Api\Inventory\ProductController::class, 'update'])->middleware('auth:sanctum');

Route::apiResource('/purchases', App\Http\Controllers\Api\Inventory\PurchaseController::class)->middleware('auth:sanctum');
Route::apiResource('/warehouse-stocks', App\Http\Controllers\Api\Inventory\WarehouseStockController::class)->middleware('auth:sanctum');


