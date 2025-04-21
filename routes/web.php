<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\TreatmentRecordController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\StockMovementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    Route::get('/charts', function () {
        return view('charts');
    })->name('charts');

    Route::get('/services', function () {
        return view('services');
    })->name('services');
    
    // Patient routes
    Route::get('/register_patients', function () {
        return view('register_patients');
    })->name('register_patients');

    // List of registered patients
    Route::get('/registered_patients', [PatientController::class, 'index'])->name('patients.index');
    // Show patient details
    Route::get('/patients/{patient_id}', [PatientController::class, 'show'])->name('patients.show_details');
    // Edit patient
    Route::get('/patients/{patient_id}/edit', [PatientController::class, 'edit'])->name('patients.edit_patient');
    // Update patient
    Route::put('/patients/{patient_id}', [PatientController::class, 'update'])->name('patients.update');
    // Store patient
    Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
    
    // Treatment records routes
    Route::get('/patients/{patient_id}/treatments/create', [TreatmentRecordController::class, 'create'])->name('treatments.create');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('appointments', AppointmentController::class);
    });

    // Inventory List
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');

    Route::resource('inventory', InventoryController::class);
    Route::get('stock-movements/create/{inventory_id}/{movement_type}', [StockMovementController::class, 'create'])->name('stock-movements.create');
    Route::post('stock-movements', [StockMovementController::class, 'store'])->name('stock-movements.store');
});

// Profile management routes (already authenticated)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
