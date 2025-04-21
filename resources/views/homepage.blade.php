<!DOCTYPE html>
<html :class="{ 'theme-white': white }" x-data="data()" lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dental Care - Welcome</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output.css') }}" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="{{ asset('assets/js/init-alpine.js') }}"></script>
</head>

<body>
  <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
    <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
      <div class="flex flex-col overflow-y-auto md:flex-row">
        <!-- Left Side: Image -->
        <div class="h-32 md:h-auto md:w-1/2">
          <img aria-hidden="true" class="object-cover w-full h-full dark:hidden" src="{{ asset('assets/img/login-office.jpeg') }}" alt="Dental Care">
          <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block" src="{{ asset('assets/img/login-office-dark.jpeg') }}" alt="Dental Care">
        </div>

        <!-- Right Side: Content -->
        <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
          <div class="w-full">
            <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">Welcome to Dental Care</h1>

            <!-- Brief Description -->
            <p class="mb-4 text-gray-700 dark:text-gray-400">
              At Dental Care, we offer top-notch dental services. Book an appointment today and take the first step to a healthier smile.
            </p>

            <!-- Button to Schedule an Appointment -->
            <a href="{{ route('appointments.create') }}" class="block w-full px-4 py-2 mt-4 text-sm font-medium text-center text-white bg-purple-600 rounded-lg hover:bg-purple-700">
              Schedule an Appointment
            </a>

            <hr class="my-8" />

            <!-- Links to More Info -->
            <div class="text-center">
              <p class="mt-4 text-sm">
                <!--a href="{{ route('services') }}" class="text-purple-600 dark:text-purple-400 hover:underline">View Our Services</a-->
              </p>
              <p class="mt-1 text-sm">
                <!--a href="{{ route('about') }}" class="text-purple-600 dark:text-purple-400 hover:underline">Learn About Us</a-->
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
