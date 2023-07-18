<?php

use App\Http\Controllers\dashboard\CaseController;
use App\Http\Controllers\dashboard\ServiceController;
use App\Http\Controllers\dashboard\EmployeeController;
use App\Http\Controllers\dashboard\ProductController;
use App\Http\Controllers\dashboard\ReviewController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//web

Route::get('/', function () {
    return view('admin.authentication.login.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.dashboard.master');
    })
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //case-study
    Route::prefix('case-study')->group(function () {
        Route::get('index', [CaseController::class, 'index'])->name('caseStudy.index');
        Route::get('create', [CaseController::class, 'create'])->name('caseStudy.create');
        Route::post('store', [CaseController::class, 'store'])->name('caseStudy.store');
        Route::get('/{id}/edit', [CaseController::class, 'edit'])->name('caseStudy.edit');
        Route::put('/{id}', [CaseController::class, 'update'])->name('caseStudy.update');
        Route::delete('/delete/{id}', [CaseController::class, 'destroy'])->name('caseStudy.destroy');
    });
    //employee
    Route::prefix('employee')->group(function () {
        Route::get('/index', [EmployeeController::class, 'index'])->name('employee.index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create');
        Route::post('/store', [EmployeeController::class, 'store'])->name('employee.store');
        Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::put('/{id}', [EmployeeController::class, 'update'])->name('employee.update');
        Route::delete('/delete/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
    });
    //Service
    Route::prefix('service')->group(function () {
        Route::get('/index', [ServiceController::class, 'index'])->name('service.index');
        Route::get('/create', [ServiceController::class, 'create'])->name('service.create');
        Route::post('/store', [ServiceController::class, 'store'])->name('service.store');
        Route::get('/edit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
        Route::put('/{id}', [ServiceController::class, 'update'])->name('service.update');
        Route::delete('/delete/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');
    });
    //Product
    Route::prefix('product')->group(function () {
        Route::get('/index', [ProductController::class, 'index'])->name('product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    });
    //review
    Route::prefix('review')->group(function () {
        Route::get('/index', [ReviewController::class, 'index'])->name('review.index');
        Route::get('/create', [ReviewController::class, 'create'])->name('review.create');
        Route::post('/store', [ReviewController::class, 'store'])->name('review.store');
        Route::get('/edit/{id}', [ReviewController::class, 'edit'])->name('review.edit');
        Route::put('/{id}', [ReviewController::class, 'update'])->name('review.update');
        Route::delete('/delete/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');
    });
});

require __DIR__ . '/auth.php';
