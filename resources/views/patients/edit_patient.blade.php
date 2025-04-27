@extends('layouts.app')

@section('content')
<main class="h-full pb-16 overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            EDIT PATIENT
        </h2>
        
            <form action="{{ route('patients.update', $patient->patient_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="w-full overflow-x-auto">
                    <div class="mb-4">
                        <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">First Name</label>
                        <input type="text" name="first_name" id="first_name" 
                               class="form-input mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600" 
                               value="{{ $patient->first_name }}">
                    </div>
                    <div class="mb-4">
                        <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Last Name</label>
                        <input type="text" name="last_name" id="last_name" 
                               class="form-input mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600" 
                               value="{{ $patient->last_name }}">
                    </div>
                    <div class="mb-4">
                        <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Gender</label>
                        <select name="gender" id="gender" 
                                class="form-input mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600">
                            <option value="Male" {{ $patient->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $patient->gender == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    
                    <div class="mt-6 flex items-center space-x-4">
    <a href="{{ url()->previous() }}" 
       class="text-gray-700 hover:underline dark:text-white">
        Back
    </a>
    <div>
        <button type="submit" class="px-4 py-2 text-sm font-medium text-green-100 border bg-green-600 rounded-lg hover:bg-green-700 dark:text-white">
            Save Changes
        </button>
    </div>

                </div>
            </form>
        </div>
    </div>
</main>
@endsection
