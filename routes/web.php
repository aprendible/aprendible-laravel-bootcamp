<?php

use App\Http\Controllers\ProfileController;
use App\Models\Chirp;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');

Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/chirps', function () {
        return view('chirps.index');
    })->name('chirps.index');

    Route::post('/chirps', function () {
        Chirp::create([
            'message' => request('message'),
            'user_id' => auth()->id(),
        ]);

        return to_route('chirps.index')
            ->with('status', __('Chirp created successfully!'));
    });
});

require __DIR__.'/auth.php';
