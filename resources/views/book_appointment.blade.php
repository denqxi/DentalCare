<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Book Appointment</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  
  <style>
    body {
      font-family: 'Times New Roman', Times, serif;
      background-color: #f0f0f0;
    }
  </style>
</head>
<body>
  <div class="flex min-h-screen">
    <!-- Left Section: Appointment Form -->
    <div class="w-full md:w-1/2 p-10 flex flex-col justify-center">
      <h1 class="text-3xl font-bold mb-4">Book your appointment with <span class="text-blue-600">Dental Care</span> in 2 minutes</h1>
      <p class="mb-6 text-gray-600">Schedule your dental appointment easily. Just fill out the form and we'll get back to you as soon as possible.</p>

       <!-- "No Patient ID? Register" Link -->
       <p class="text-sm text-gray-500 mb-4">
        No patient ID? <a href="javascript:void(0);" onclick="openRegistrationModal()" class="text-blue-600 hover:underline">Register here</a>.
      </p>

      <form class="space-y-4" action="{{ route('book.appointment') }}" method="POST">
        @csrf  

        <input type="text" id="patient-id" name="patient_id" placeholder="Enter Patient ID (Sent via Email)" class="w-full p-3 border rounded-md bg-gray-100" onblur="fetchPatientDetails()">

        <input type="text" id="full-name" name="full_name" placeholder="Full Name" class="w-full p-3 border rounded-md bg-gray-100" readonly>

        <input type="tel" id="phone-number" name="phone_number" placeholder="Phone Number" class="w-full p-3 border rounded-md bg-gray-100" required>

        <!-- Gender Selection -->
        <div class="flex gap-4">
            <label class="flex items-center">
                <input type="hidden" name="gender" value="Male" id="gender-male" class="mr-2"> Male
            </label>
            <label class="flex items-center">
                <input type="hidden" name="gender" value="Female" id="gender-female" class="mr-2"> Female
            </label>
            <label class="flex items-center">
                <input type="hidden " name="gender" value="Other" id="gender-other" class="mr-2"> Other
            </label>
        </div>

        <div class="flex gap-4">
            <select name="treatment" class="w-1/2 p-3 border rounded-md bg-gray-100">
                <option disabled selected>Select Treatment</option>
                <option>Teeth Whitening</option>
                <option>Braces</option>
                <option>Cleaning</option>
                <option>Dental Fillings</option>
                <option>Root Canal Treatment</option>
                <option>Tooth Extraction</option>
                <option>Gum Surgery</option>
                <option>Veneers</option>
            </select>

            <input type="date" name="appointment_date" class="w-1/2 p-3 border rounded-md bg-gray-100">
        </div>

        <textarea name="message" placeholder="Write message" rows="4" class="w-full p-3 border rounded-md bg-gray-100"></textarea>

        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-md">Book Appointment</button>
        
        <p class="text-left text-sm text-gray-400 mt-4">© 2025 Dental Care – All Rights Reserved.</p>
      </form>
    </div>
    
    <!-- Right Section: Image -->
    <div class="hidden md:block w-1/2">
      <img src="/assets/img/homepage_and_book/book.jpg" alt="Image" class="w-full h-full object-cover">
    </div>
  </div>

  <!-- Registration Form Modal -->
  <div id="registration-modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-md w-96">
      <h2 class="text-2xl font-bold mb-4">Register as a New Patient</h2>
      <form id="registration-form" action="{{ route('patients.store') }}" method="POST">
        @csrf
        <input type="text" name="first_name" placeholder="Enter First Name" class="w-full p-3 border rounded-md bg-gray-100 mb-4" required>
        <input type="text" name="middle_name" placeholder="Enter Middle Name (Optional)" class="w-full p-3 border rounded-md bg-gray-100 mb-4">
        <input type="text" name="last_name" placeholder="Enter Last Name" class="w-full p-3 border rounded-md bg-gray-100 mb-4" required>
        
        <input type="tel" name="phone" placeholder="Enter Phone Number" class="w-full p-3 border rounded-md bg-gray-100 mb-4" required>
        
        <!-- Gender Selection -->
        <div class="flex gap-4 mb-4">
          <label class="flex items-center">
            <input type="radio" name="gender" value="Male" class="mr-2" required> Male
          </label>
          <label class="flex items-center">
            <input type="radio" name="gender" value="Female" class="mr-2" required> Female
          </label>
          <label class="flex items-center">
            <input type="radio" name="gender" value="Other" class="mr-2" required> Other
          </label>
        </div>

        <input type="email" name="email" placeholder="Enter Email" class="w-full p-3 border rounded-md bg-gray-100 mb-4" required>
        <input type="date" name="birth_date" placeholder="Enter Birth Date" class="w-full p-3 border rounded-md bg-gray-100 mb-4" required>
        <input type="text" name="address" placeholder="Enter Address" class="w-full p-3 border rounded-md bg-gray-100 mb-4" required>

        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-md">Register</button>
      </form>
      <button onclick="closeRegistrationModal()" class="w-full text-center text-sm text-gray-400 mt-4">Cancel</button>
    </div>
  </div>

  <script>
    function fetchPatientDetails() {
        const patientId = document.getElementById('patient-id').value;

        // Make an AJAX request to fetch patient details
        fetch(`/api/patient-details/${patientId}`)
            .then(response => response.json())
            .then(data => {
                if (data && data.patient) {
                    document.getElementById('full-name').value = data.patient.first_name + ' ' + (data.patient.middle_name || '') + ' ' + data.patient.last_name;
                    document.getElementById('phone-number').value = data.patient.phone;
                    
                    // Update gender selection
                    if (data.patient.gender === 'Male') {
                        document.getElementById('gender-male').checked = true;
                    } else if (data.patient.gender === 'Female') {
                        document.getElementById('gender-female').checked = true;
                    } else if (data.patient.gender === 'Other') {
                        document.getElementById('gender-other').checked = true;
                    }
                } else {
                    alert('Patient not found!');
                }
            })
            .catch(error => {
                console.error('Error fetching patient details:', error);
            });
    }

    // Function to open registration modal
    function openRegistrationModal() {
      document.getElementById('registration-modal').style.display = 'flex';
    }

    // Function to close registration modal
    function closeRegistrationModal() {
      document.getElementById('registration-modal').style.display = 'none';
    }

    document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById('registration-form'); // Get form by ID

            form.addEventListener("submit", function (event) {
                event.preventDefault(); // Prevent default form submission (page reload)

                const formData = new FormData(form); // Gather form data

                // Perform the AJAX request using fetch()
                fetch("{{ route('patients.store') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector("input[name=_token]").value
                    }
                })
                .then(response => response.json()) // Parse JSON response
                .then(data => {
                    if (data.status === "success") {
                        // Display success message via Toast or alert
                        showToast("Patient registered successfully!");
                        form.reset(); // Reset form fields

                        // Optionally, redirect to another page
                        // window.location.replace("{{ route('patients.index') }}");
                    } else {
                        // Handle error
                        showToast("Error occurred! Please try again.");
                    }
                })
                .catch(error => {
                    // Log and display unexpected errors
                    console.error("Error:", error);
                    showToast("An unexpected error occurred.");
                });
            });
        });

        document.getElementById('appointment-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the form from submitting normally

            const patientId = document.getElementById('patient-id').value;
            const fullName = document.getElementById('full-name').value;
            const phoneNumber = document.getElementById('phone-number').value;
            const gender = document.querySelector('input[name="gender"]:checked') ? document.querySelector('input[name="gender"]:checked').value : '';
            const treatment = document.getElementById('treatment').value;
            const appointmentDate = document.getElementById('appointment-date').value;
            const message = document.getElementById('message').value;

            // Send data to the server using Axios
            axios.post('/api/book-appointment', {
                patient_id: patientId,
                full_name: fullName,
                phone_number: phoneNumber,
                gender: gender,
                treatment: treatment,
                appointment_date: appointmentDate,
                message: message
            })
            .then(response => {
                console.log('Appointment booked successfully:', response);
                // You can add a success message or redirect user here
            })
            .catch(error => {
                console.error('Error booking appointment:', error);
                // Show an error message if something went wrong
            });
        });
  </script>
</body>
</html>
