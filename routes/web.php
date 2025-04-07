<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    Route::get('/buttons', function () {
        return view('buttons');
    })->name('buttons');

    Route::get('/cards', function () {
        return view('cards');
    })->name('cards');

    Route::get('/charts', function () {
        return view('charts');
    })->name('charts');

    Route::get('/forms', function () {
        return view('forms');
    })->name('form');

    Route::get('/modals', function () {
        return view('modals');
    })->name('modals');

    Route::get('/tables', function () {
        return view('tables');
    })->name('tables');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/patients/store', [PatientController::class, 'store'])->name('patients.store');
});

require __DIR__.'/auth.php';
