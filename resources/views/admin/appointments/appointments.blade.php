@extends('layouts.app')

@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                APPOINTMENTS
            </h2>

            <!-- Search Bar -->
            <div class="mb-6">
                <form action="{{ route('admin.appointments.index') }}" method="GET">
                    <input type="text" id="searchInput" name="search" class="form-control" value="{{ request('search') }}" placeholder="Search by patient name or dental type">
                    <button 
                        type="submit" 
                        class="px-4 py-2 text-sm font-medium text-green-100 border bg-green-600 rounded-lg hover:bg-green-700 dark:text-white">
                        Search
                    </button>
                </form>
            </div>

            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">Patient's Name</th>
                                <th class="px-4 py-3">Dental Type</th>
                                <th class="px-4 py-3">Gender</th>
                                <th class="px-4 py-3">Date</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Notes</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @forelse ($appointments as $appointment)
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">{{ $appointment->patient->name }}</td>
                                    <td class="px-4 py-3">{{ $appointment->treatment_type ?? 'N/A' }}</td>
                                    <td class="px-4 py-3">{{ $appointment->patient->gender ?? 'N/A' }}</td>
                                    <td class="px-4 py-3">{{ $appointment->appointment_date->format('m/d/Y') }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-3 py-1 text-sm font-semibold rounded-lg"
                                            style="background-color: {{ getStatusColor($appointment->status) }};">
                                            {{ $appointment->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">{{ $appointment->notes ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
                                        No appointments yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="py-4">
                {{ $appointments->links() }}
            </div>
        </div>
    </main>
@endsection
