@extends('layouts.app')

@section('content')
    <main class="h-full overflow-y-auto min-h-screen" style="background: linear-gradient(to bottom, #e0f7fa, #b2ebf2);">
        <div class="container mx-auto mt-8">
            <div class="bg-white rounded-xl shadow-md p-6 w-full md:w-3/4 mx-auto">
                <h2 class="text-xl font-bold text-blue-800 mb-4 border-b pb-2">🕓 PATIENT'S HISTORY</h2>

                <div class="overflow-x-auto rounded-lg border border-blue-300 bg-blue-50">
                    <table class="w-full text-sm text-left text-gray-700">
                        <thead class="bg-blue-200 text-blue-800 uppercase text-xs font-semibold">
                            <tr>
                                <th class="px-4 py-3">Patient Name</th>
                                <th class="px-4 py-3">Age</th>
                                <th class="px-4 py-3">Gender</th>
                                <th class="px-4 py-3">Phone #</th>
                                <th class="px-4 py-3">History</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($patients) && count($patients) > 0)
                                @foreach ($patients as $patient)
                                    <tr class="bg-white border-b hover:bg-blue-100">
                                        <td class="px-4 py-3 font-medium text-gray-900">
                                            {{ $patient->first_name ?? '' }} {{ $patient->last_name ?? '' }}
                                        </td>
                                        <td class="px-4 py-3">
                                            @if(isset($patient->birth_date))
                                                {{ \Carbon\Carbon::parse($patient->birth_date)->age }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">{{ $patient->gender ?? '' }}</td>
                                        <td class="px-4 py-3">{{ $patient->phone ?? '' }}</td>
                                        <td class="px-4 py-3">
                                            <a href="{{ route('history.show', $patient->id ?? '') }}" class="text-orange-600 hover:underline">
                                                view history
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="px-4 py-3" colspan="5">No patients found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </main>
@endsection