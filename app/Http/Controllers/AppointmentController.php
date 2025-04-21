<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve the search input (if any)
        $search = $request->get('search', '');

        // Fetch appointments with pagination and apply search filtering
        $appointments = Appointment::with('patient') // Include patient information
            ->when($search, function ($query, $search) {
                return $query->whereHas('patient', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->orWhere('treatment_type', 'like', "%{$search}%"); // Adjust as needed
            })
            ->paginate(10); // Paginate with 10 records per page

        // Pass appointments data to the view
        return view('admin.appointments.appointments', compact('appointments', 'search'));
    }

    public function store(Request $request)
    {
        // Validate the data
        $validated = $request->validate([
            'patient_name' => 'required|string|max:255',
            'appointment_date' => 'required|date',
            'treatment_type' => 'required|string',
        ]);

        // Create the appointment in the database
        $appointment = Appointment::create([
            'patient_name' => $validated['patient_name'],
            'appointment_date' => $validated['appointment_date'],
            'treatment_type' => $validated['treatment_type'],
            'status' => 'pending', // Default status for a new appointment
        ]);

        // Redirect with a success message
        return redirect('/')->with('success', 'Appointment booked successfully!');
    }
}