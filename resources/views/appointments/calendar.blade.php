<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-authenticated" content="{{ auth()->check() ? 'true' : 'false' }}">
    <title>Book Appointment - CLINIVIE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gradient-to-r from-sky-500 to-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-sky-600 to-blue-600 bg-clip-text text-transparent">CLINIVIE</span>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('welcome') }}" class="text-gray-700 hover:text-sky-600 font-medium transition-colors">Home</a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-sky-600 font-medium transition-colors">About Us</a>
                    <a href="{{ route('welcome') }}#services" class="text-gray-700 hover:text-sky-600 font-medium transition-colors">Services</a>
                    <a href="{{ route('pharmacy') }}" class="text-gray-700 hover:text-sky-600 font-medium transition-colors">Pharmacy</a>
                    <a href="{{ route('welcome') }}#contact" class="text-gray-700 hover:text-sky-600 font-medium transition-colors">Contact</a>
                </nav>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-sky-600 font-medium transition-colors px-4 py-2">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-sky-600 font-medium transition-colors px-4 py-2">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-sky-600 font-medium transition-colors px-4 py-2">
                            Log In
                        </a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-sky-500 to-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:from-sky-600 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg">
                            Sign Up
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Add hospital illustration at the top -->
    <div class="flex flex-col items-center mb-8">
        <img src="https://www.svgrepo.com/show/331984/hospital-building.svg" alt="Hospital" class="w-24 h-24 mb-2">
        <h2 class="text-2xl font-bold text-blue-700">Book Your Hospital Appointment</h2>
        <p class="text-gray-500">Select a date, choose your doctor or nurse, and book your visit easily.</p>
    </div>

    <!-- Remove the Hero Section -->
    <!-- Remove the Service Selection and Payment logic -->
    <!-- Only show: Date picker, then doctor/nurse selection, then time slots, then Book button -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div id="bookingForm">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column - Filters -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24">
                            <h3 class="text-xl font-bold text-gray-900 mb-6">Select Date & Doctor</h3>
                            <!-- Date Selection -->
                            <div class="mb-6">
                                <label for="appointment_date" class="block text-sm font-semibold text-gray-700 mb-3">Select Date</label>
                                <input type="date" id="appointment_date" name="appointment_date" 
                                       min="{{ now()->format('Y-m-d') }}" 
                                       max="{{ now()->addMonths(3)->format('Y-m-d') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-sky-500 focus:border-sky-500" required>
                            </div>
                            <!-- Doctor Selection: add icon -->
                            <div class="mb-6" id="doctorSelectWrapper" style="display:none;">
                                <label for="doctor_id" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4" fill="#bae6fd"/><rect x="6" y="14" width="12" height="6" rx="3" fill="#2563eb"/></svg>
                                    Choose Doctor
                                </label>
                                <select id="doctor_id" name="doctor_id" class="w-full px-4 py-3 border border-blue-200 rounded-xl focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="">Select a doctor</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor['id'] }}">
                                            {{ $doctor['name'] }} - {{ $doctor['specialization'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Nurse Selection: add icon if needed -->
                        </div>
                    </div>
                    <!-- Right Column - Time Slots -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl shadow-lg p-6">
                            <h3 class="text-xl font-bold text-blue-700 mb-6 flex items-center gap-2">
                                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2" fill="#e0f2fe"/><path d="M8 2v4M16 2v4M3 10h18" stroke="#2563eb" stroke-width="2"/></svg>
                                Available Time Slots
                            </h3>
                            <div id="timeSlotsContainer">
                                <!-- Time slots will be loaded here dynamically -->
                            </div>
                            <!-- Book Button -->
                            <div class="mt-8 text-center">
                                <button type="submit" id="bookButton" 
                                        class="btn-primary px-12 py-4 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700"
                                        disabled>
                                    <svg class="w-5 h-5 inline-block mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2" fill="#e0f2fe"/><path d="M8 2v4M16 2v4M3 10h18" stroke="#fff" stroke-width="2"/></svg>
                                    Book Appointment
                                </button>
                                @guest
                                    <p class="mt-3 text-sm text-gray-600">
                                        <a href="{{ route('login') }}" class="text-sky-600 hover:text-sky-800 underline">Log in</a> 
                                        or 
                                        <a href="{{ route('register') }}" class="text-sky-600 hover:text-sky-800 underline">create an account</a> 
                                        to book an appointment
                                    </p>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="module">
        import './appointment-booking.js';
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('appointment_date');
            const doctorWrapper = document.getElementById('doctorSelectWrapper');
            dateInput.addEventListener('change', function() {
                if (dateInput.value) {
                    doctorWrapper.style.display = '';
                } else {
                    doctorWrapper.style.display = 'none';
                }
            });
            if (dateInput.value) doctorWrapper.style.display = '';
        });
    </script>
</body>
</html> 
