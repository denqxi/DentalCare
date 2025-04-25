<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Patient;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve the search input (if any)
        $search = $request->input('search');

        // Fetch appointments with pagination and apply search filtering
        $appointments = Appointment::with('patient')
            ->whereHas('patient', function ($query) use ($search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('middle_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%");
            })
            ->orWhere('treatment_type', 'like', "%{$search}%")
            ->paginate(10); // Paginate with 10 records per page

        // Pass appointments data to the view
        return view('admin.appointments.appointments', compact('appointments'));
    }

    public function create()
    {
        return view('book_appointment');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required',
            'phone_number' => 'required',
            'treatment' => 'required',
            'appointment_date' => 'required|date',
            'message' => 'nullable|string',
        ]);

        // Find patient by patient_id
        $patient = Patient::find($validated['patient_id']);

        // Check if the patient exists
        if (!$patient) {
            return redirect()->back()->with('error', 'Patient not found.');
        }

        // Create a new appointment
        Appointment::create([
            'patient_id' => $validated['patient_id'],
            'treatment_type' => $validated['treatment'],
            'appointment_date' => $validated['appointment_date'],
            'message' => $validated['message'] ?? null, // Handle null values for message
        ]); 

        return redirect()->route('book.appointment')->with('success', 'Appointment booked successfully!');
    }

    public function manage($id)
    {
        $appointment = Appointment::with('patient')->findOrFail($id);

        return view('admin.appointments.manage', compact('appointment'));
    }
}