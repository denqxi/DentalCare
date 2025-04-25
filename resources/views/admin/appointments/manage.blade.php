@extends('layouts.app')

@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Manage Appointment
            </h2>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Appointment Details</h3>
                <p><strong>Patient Name:</strong> {{ $appointment->patient->first_name }} {{ $appointment->patient->middle_name }} {{ $appointment->patient->last_name }}</p>
                <p><strong>Treatment Type:</strong> {{ $appointment->treatment_type }}</p>
                <p><strong>Appointment Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('m/d/Y') }}</p>
                <p><strong>Status:</strong> {{ $appointment->status }}</p>
                <p><strong>Notes:</strong> {{ $appointment->notes ?? 'N/A' }}</p>

                <form action="{{ route('admin.appointments.updateStatus', $appointment->id) }}" method="POST" class="mt-4">
                    @csrf
                    @method('PATCH')
                    <label for="status" class="block text-sm font-medium text-gray-700">Update Status</label>
                    <select name="status" id="status" class="form-control mt-1">
                        <option value="Pending" {{ $appointment->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Completed" {{ $appointment->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Cancelled" {{ $appointment->status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="mt-2 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </main>
@endsection