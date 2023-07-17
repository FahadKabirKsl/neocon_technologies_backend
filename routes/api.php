<?php

use App\Http\Controllers\api\CaseController;
use App\Http\Controllers\api\EmployeeController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\ServiceController;
use App\Http\Controllers\api\ReviewController;
use App\Http\Controllers\AuthController;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Authentication
Route::post('/registration', [AuthController::class, 'registration']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

//case-study
Route::prefix('case-study')->group(function () {
    Route::get('/', [CaseController::class, 'index']);
    Route::get('/create', [CaseController::class, 'create']);
    Route::post('/store', [CaseController::class, 'store']);
    Route::post('/{id}', [CaseController::class, 'update']);
    Route::delete('/delete/{id}', [CaseController::class, 'destroy']);
});
//service
Route::prefix('service')->group(function () {
    Route::get('/', [ServiceController::class, 'index']);
    Route::post('/store', [ServiceController::class, 'store']);
    Route::post('/{id}', [ServiceController::class, 'update']);
    Route::delete('/delete/{id}', [ServiceController::class, 'destroy']);
});
//employee
Route::prefix('employee')->group(function () {
    Route::get('/', [EmployeeController::class, 'index']);
    Route::post('/store', [EmployeeController::class, 'store']);
    Route::post('/{id}', [EmployeeController::class, 'update']);
    Route::delete('/delete/{id}', [EmployeeController::class, 'destroy']);
});

//product
Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/store', [ProductController::class, 'store']);
    Route::post('/{id}', [ProductController::class, 'update']);
    Route::delete('/delete/{id}', [ProductController::class, 'destroy']);
});
//review
Route::prefix('review')->group(function () {
    Route::get('/', [ReviewController::class, 'index']);
    Route::post('/store', [ReviewController::class, 'store']);
    Route::post('/{id}', [ReviewController::class, 'update']);
    Route::delete('/delete/{id}', [ReviewController::class, 'destroy']);
});
