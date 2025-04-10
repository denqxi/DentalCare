@extends('layouts.app')

@section('content')
    <main class="h-full pb-16 overflow-y-auto min-h-screen" style="background: linear-gradient(to bottom, #e0f7fa, #b2ebf2);">
        <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-bold text-gray-700 dark:text-gray-200" style="color: #000;">
        🩺 PATIENT'S REGISTRATION
</h2>   

            <div class="px-4 py-3 mb-8 rounded-lg shadow-md" style="background-color: #ffffff;">
                <form method="POST" action="{{ route('patients.store') }}">
                    @csrf  {{-- Protects against CSRF attacks --}}

                    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-3">
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400" style="color: #000;">First Name</span>
                            <input name="first_name" class="block w-full mt-1 text-sm form-input rounded-md" placeholder="Jane" style="border-color: #cbd5e0; background-color: #fff; color: #000;">
                        </label>

                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400" style="color: #000;">Middle Name</span>
                            <input name="middle_name" class="block w-full mt-1 text-sm form-input rounded-md" placeholder="Snape" style="border-color: #cbd5e0; background-color: #fff; color: #000;">
                        </label>

                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400" style="color: #000;">Last Name</span>
                            <input name="last_name" class="block w-full mt-1 text-sm form-input rounded-md" placeholder="Severus" style="border-color: #cbd5e0; background-color: #fff; color: #000;">
                        </label>

                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400" style="color: #000;">Birth Date</span>
                            <input type="date" name="birth_date" class="block w-full mt-1 text-sm form-input rounded-md" style="border-color: #cbd5e0; background-color: #fff; color: #000;">
                        </label>

                        <div class="mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400" style="color: #000;">Gender</span>
                            <div class="mt-2">
                                <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                    <input type="radio" name="gender" value="Male" class="form-radio text-purple-600 rounded-full" style="color: #6b46c1;">
                                    <span class="ml-2" style="color: #000;">Male</span>
                                </label>
                                <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                    <input type="radio" name="gender" value="Female" class="form-radio text-purple-600 rounded-full" style="color: #6b46c1;">
                                    <span class="ml-2" style="color: #000;">Female</span>
                                </label>
                            </div>
                        </div>

                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400" style="color: #000;">Address</span>
                            <input name="address" class="block w-full mt-1 text-sm form-input rounded-md" placeholder="Address" style="border-color: #cbd5e0; background-color: #fff; color: #000;">
                        </label>

                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400" style="color: #000;">Email Address</span>
                            <input type="email" name="email" class="block w-full mt-1 text-sm form-input rounded-md" placeholder="jane@example.com" style="border-color: #cbd5e0; background-color: #fff; color: #000;">
                        </label>

                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400" style="color: #000;">Phone Number</span>
                            <input name="phone_number" class="block w-full mt-1 text-sm form-input rounded-md" placeholder="Phone Number" style="border-color: #cbd5e0; background-color: #fff; color: #000;">
                        </label>
                    </div>

                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white rounded-md" style="background-color: #00897b; color: #fff; hover:bg-teal-700;">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </main>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelector("form").addEventListener("submit", function (event) {
            event.preventDefault(); 

            let form = this;
            let formData = new FormData(form);

            fetch("{{ route('patients.store') }}", {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector("input[name=_token]").value
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    alert("Patient registered successfully!");
                    form.reset(); 
                } else {
                    alert("Registration failed! Please check the form.");
                    console.error("Errors:", data.errors);
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });
    </script>
@endsection