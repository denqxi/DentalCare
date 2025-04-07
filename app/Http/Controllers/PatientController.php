<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Mail;
use App\Mail\PatientRegistered;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PatientController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate form data
            $validated = $request->validate([
                'first_name'   => 'required|string|max:255',
                'middle_name'  => 'nullable|string|max:255',
                'last_name'    => 'required|string|max:255',
                'birth_date'   => 'required|date',
                'gender'       => 'required|in:Male,Female',
                'address'      => 'required|string|max:255',
                'email'        => 'required|email|unique:patients,email',
                'phone_number' => 'required|string|max:15',
            ]);

            // Generate a unique 5-character patient ID
            do {
                $patient_id = strtoupper(Str::random(5));
            } while (Patient::where('patient_id', $patient_id)->exists());

            // Store patient data
            $patient = Patient::create([
                'patient_id'   => $patient_id,
                'first_name'   => $validated['first_name'],
                'middle_name'  => $validated['middle_name'] ?? null,
                'last_name'    => $validated['last_name'],
                'birth_date'   => $validated['birth_date'],
                'gender'       => $validated['gender'],
                'address'      => $validated['address'],
                'email'        => $validated['email'],
                'phone' => $validated['phone_number'],
            ]);

            // Log the created patient for debugging
            Log::info('New patient registered:', ['patient' => $patient]);

            // Send email notification (disable in local testing if needed)
            Mail::to($patient->email)->send(new PatientRegistered($patient));

            // Return a JSON response for AJAX requests
            return response()->json([
                'status'  => 'success',
                'message' => 'Patient registered successfully!',
                'data'    => $patient
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            Log::error('Validation failed:', ['errors' => $e->errors()]);

            return response()->json([
                'status' => 'error',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            // Log unexpected errors
            Log::error('Registration error:', ['message' => $e->getMessage()]);

            return response()->json([
                'status'  => 'error',
                'message' => 'An unexpected error occurred. Please try again later.'
            ], 500);
        }
    }
}