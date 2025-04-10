@extends('layouts.app')

@section('content')
    <main class="h-full pb-16 overflow-y-auto min-h-screen" style="background: linear-gradient(to bottom, #e0f7fa, #b2ebf2);">
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-bold text-black">
            📝 PATIENT REGISTERED
            </h2>

            <div class="px-4 py-3 mb-8 rounded-lg shadow-md" style="background-color: #ffffff;">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700">
                        <thead class="text-xs text-black uppercase">
                            <tr>
                                <th class="px-4 py-2">Patient's Name</th>
                                <th class="px-4 py-2">Birthdate</th>
                                <th class="px-4 py-2">Gender</th>
                                <th class="px-4 py-2">Address</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Phone #</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($patients) && count($patients) > 0)
                                @foreach ($patients as $patient)
                                    <tr class="bg-white border-b hover:bg-blue-50">
                                        <td class="px-4 py-2 font-medium text-gray-900">{{ $patient->first_name }} {{ $patient->last_name }}</td>
                                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($patient->birth_date)->format('m/d/Y') }}</td>
                                        <td class="px-4 py-2">{{ $patient->gender }}</td>
                                        <td class="px-4 py-2">{{ Str::limit($patient->address, 20, '...') }}</td>
                                        <td class="px-4 py-2">{{ $patient->email }}</td>
                                        <td class="px-4 py-2">{{ $patient->phone }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="px-4 py-2" colspan="6">No patients registered.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection