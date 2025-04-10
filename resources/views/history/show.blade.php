@extends('layouts.app')

@section('content')
    <main class="h-full overflow-y-auto bg-blue-100 min-h-screen">
        <div class="container mx-auto mt-8">
            <div class="bg-white rounded-xl shadow-md p-6 w-full md:w-3/4 mx-auto">
                <h2 class="text-xl font-bold text-blue-800 mb-4 border-b pb-2">
                     Patient History for {{ $patient->first_name ?? '' }} {{ $patient->last_name ?? '' }}
                </h2>

                <div class="mb-4">
                    <p><strong>Age:</strong>
                        @if(isset($patient->birth_date))
                            {{ \Carbon\Carbon::parse($patient->birth_date)->age }}
                        @else
                            N/A
                        @endif
                    </p>
                    <p><strong>Gender:</strong> {{ $patient->gender ?? '' }}</p>
                    <p><strong>Phone:</strong> {{ $patient->phone ?? '' }}</p>
                    </div>

                <div class="overflow-x-auto rounded-lg border border-blue-300 bg-blue-50">
                    <table class="w-full text-sm text-left text-gray-700">
                        <thead class="bg-blue-200 text-blue-800 uppercase text-xs font-semibold">
                            <tr>
                                <th class="px-4 py-3">Date</th>
                                <th class="px-4 py-3">Service/Treatment</th>
                                <th class="px-4 py-3">Notes</th>
                                </tr>
                        </thead>
                        <tbody>
                            @if(isset($histories) && count($histories) > 0)
                                @foreach ($histories as $history)
                                    <tr class="bg-white border-b hover:bg-blue-100">
                                        <td class="px-4 py-3">{{ $history->date ?? '' }}</td>
                                        <td class="px-4 py-3">{{ $history->service ?? '' }}</td>
                                        <td class="px-4 py-3">{{ $history->notes ?? '' }}</td>
                                        </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="px-4 py-3" colspan="3">No history found for this patient.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <a href="{{ route('history.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Back to Patient List
                    </a>
                </div>

            </div>
        </div>
    </main>
@endsection