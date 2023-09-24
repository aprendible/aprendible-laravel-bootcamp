<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');

Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/chirps', [ChirpController::class, 'index'])
        ->name('chirps.index');

    Route::post('/chirps', [ChirpController::class, 'store'])
        ->name('chirps.store');

    Route::get('/chirps/{chirp}/edit', [ChirpController::class, 'edit'])
        ->name('chirps.edit');

    Route::put('/chirps/{chirp}', [ChirpController::class, 'update'])
        ->name('chirps.update');

    Route::delete('/chirps/{chirp}', [ChirpController::class, 'destroy'])
        ->name('chirps.destroy');
});

require __DIR__.'/auth.php';
