@extends('layouts.app')

@section('content')
<main class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Edit Patient
        </h2>

        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <form action="{{ route('patients.update', $patient->patient_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="w-full overflow-x-auto">
                    <div class="mb-4">
                        <label for="first_name" class="block text-sm font-medium">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-input mt-1 block w-full" value="{{ $patient->first_name }}">
                    </div>
                    <div class="mb-4">
                        <label for="last_name" class="block text-sm font-medium">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-input mt-1 block w-full" value="{{ $patient->last_name }}">
                    </div>
                    <div class="mb-4">
                        <label for="gender" class="block text-sm font-medium">Gender</label>
                        <select name="gender" id="gender" class="form-input mt-1 block w-full">
                            <option value="Male" {{ $patient->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $patient->gender == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <!-- Add other fields as needed -->

                    <div class="mt-6">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
