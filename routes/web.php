<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\TreatmentRecordController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/book-appointment', function () {
    return view('book_appointment');
})->name('book.appointment'); 

Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');

Route::get('/reports/patient-history', [ReportController::class, 'generatePatientHistory'])->name('reports.patient_history');
Route::get('/reports/treatment-report', [ReportController::class, 'generateTreatmentReport'])->name('reports.treatment_report');
Route::get('/reports/treatments', [TreatmentRecordController::class, 'showReport'])->name('reports.treatments');

Route::get('/api/patient-details/{id}', [PatientController::class, 'fetchPatientDetails']);
Route::get('/book-appointment', [AppointmentController::class, 'create'])->name('appointments.book');
Route::post('/book-appointment', [AppointmentController::class, 'store'])->name('book.appointment');


// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        return view('dashboard');
    });

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

    Route::get('/', function () {
        return view('homepage');
    })->name('homepage');

    // List of registered patients
    Route::get('/registered_patients', [PatientController::class, 'index'])->name('patients.index');
    // Show patient details
    Route::get('/patients/{patient_id}', [PatientController::class, 'show'])->name('patients.show_details');
    // Edit patient
    Route::get('/patients/{patient_id}/edit', [PatientController::class, 'edit'])->name('patients.edit_patient');
    // Update patient
    Route::put('/patients/{patient_id}', [PatientController::class, 'update'])->name('patients.update');
    
    // Treatment records routes
    Route::get('/patients/{patient_id}/treatments/create', [TreatmentRecordController::class, 'create'])->name('treatments.create');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('appointments', AppointmentController::class);
    });
    Route::get('/admin/appointments/{id}/manage', [App\Http\Controllers\AppointmentController::class, 'manage'])->name('admin.appointments.manage');

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
