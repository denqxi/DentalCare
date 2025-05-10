@extends('layouts.app')

@section('content')

<main class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            PATIENT DETAILS
        </h2>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <th class="px-4 py-3">Patient ID</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Gender</th>
                            <th class="px-4 py-3">Birth Date</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Phone</th>
                            <th class="px-4 py-3">Address</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">{{ $patient->patient_id }}</td>
                            <td class="px-4 py-3 text-sm">{{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}</td>
                            <td class="px-4 py-3 text-sm">{{ $patient->gender }}</td>
                            <td class="px-4 py-3 text-sm">{{ $patient->birth_date }}</td>
                            <td class="px-4 py-3 text-sm">{{ $patient->email }}</td>
                            <td class="px-4 py-3 text-sm">{{ $patient->phone }}</td>
                            <td class="px-4 py-3 text-sm">{{ $patient->address }}</td>
                        </tr>
                    </tbody>
                </table>
                
                <!-- Medical History -->
                <h3 class="mt-6 text-xl font-semibold text-gray-600 dark:text-gray-200 ml-4">Medical History</h3>
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <th class="px-4 py-3">Condition</th>
                            <th class="px-4 py-3">Diagnosis Date</th>
                            <th class="px-4 py-3">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach($patient->medicalHistories as $history)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">{{ $history->condition }}</td>
                                <td class="px-4 py-3 text-sm">{{ $history->diagnosis_date }}</td>
                                <td class="px-4 py-3 text-sm">{{ $history->notes }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Treatment Records -->
                <h3 class="mt-6 text-xl font-semibold text-gray-600 dark:text-gray-200 ml-4">Treatment Records</h3>
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <th class="px-4 py-3">Treatment Date</th>
                            <th class="px-4 py-3">Treatment Type</th>
                            <th class="px-4 py-3">Doctor's Notes</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach($patient->treatmentRecords as $record)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">{{ $record->treatment_date }}</td>
                                <td class="px-4 py-3 text-sm">{{ $record->treatment_type }}</td>
                                <td class="px-4 py-3 text-sm">{{ $record->doctor_notes }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Appointments -->
                <h3 class="mt-6 text-xl font-semibold text-gray-600 dark:text-gray-200 ml-4">Appointments</h3>
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <th class="px-4 py-3">Appointment Date</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach($patient->appointments as $appointment)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">{{ $appointment->appointment_date }}</td>
                                <td class="px-4 py-3 text-sm">{{ $appointment->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-6 flex space-x-4 ml-6">
    <a href="{{ route('patients.edit_patient', $patient->patient_id) }}" class="px-4 py-2 text-sm font-medium text-green-100 border  bg-green-600 rounded-lg hover:bg-green-700 dark:text-white">
        Edit
    </a>
    <a href="{{ route('patients.index') }}" class="inline-block ml-4 px-4 py-2 text-sm font-semibold text-gray-800 dark:text-white bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-400">
    Back to list
</a>


            </div>
        </div>
    </div>
</main>
@endsection
