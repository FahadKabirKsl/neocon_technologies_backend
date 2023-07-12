<?php

use App\Http\Controllers\api\CaseController;
use App\Http\Controllers\AuthController;
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
