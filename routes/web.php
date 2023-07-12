<?php

use App\Http\Controllers\dashboard\CaseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//web

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.dashboard.master');
    })->middleware(['auth', 'verified'])->name('dashboard');

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
});

require __DIR__ . '/auth.php';