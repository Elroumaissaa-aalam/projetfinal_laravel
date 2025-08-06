<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy - CLINIVIE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-sky-600">CLINIVIE</h1>
                </div>
                
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('welcome') }}" class="text-gray-700 hover:text-sky-600 font-medium transition-colors">Home</a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-sky-600 font-medium transition-colors">About Us</a>
                    <a href="{{ route('welcome') }}#services" class="text-gray-700 hover:text-sky-600 font-medium transition-colors">Services</a>
                    <a href="{{ route('pharmacy') }}" class="text-sky-600 hover:text-sky-700 font-medium transition-colors">Pharmacy</a>
                    <a href="{{ route('welcome') }}#contact" class="text-gray-700 hover:text-sky-600 font-medium transition-colors">Contact</a>
                </nav>

                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-sky-600 text-white px-4 py-2 rounded-lg hover:bg-sky-700 transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-sky-600 font-medium">Log In</a>
                        <a href="{{ route('register') }}" class="bg-sky-600 text-white px-4 py-2 rounded-lg hover:bg-sky-700 transition-colors">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">CLINIVIE Pharmacy</h1>
                <p class="text-xl text-gray-600">Your trusted partner in health and wellness</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Prescription Services -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="text-sky-600 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Prescription Services</h3>
                    <p class="text-gray-600">Fast and accurate prescription filling with consultation services.</p>
                </div>

                <!-- Over-the-Counter -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="text-sky-600 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Over-the-Counter</h3>
                    <p class="text-gray-600">Wide selection of OTC medications and health products.</p>
                </div>

                <!-- Health Consultations -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="text-sky-600 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Health Consultations</h3>
                    <p class="text-gray-600">Professional pharmacist consultations and medication reviews.</p>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="mt-12 bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-center mb-6">Visit Our Pharmacy</h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-3">Hours of Operation</h3>
                        <ul class="space-y-2 text-gray-600">
                            <li>Monday - Friday: 8:00 AM - 8:00 PM</li>
                            <li>Saturday: 9:00 AM - 6:00 PM</li>
                            <li>Sunday: 10:00 AM - 4:00 PM</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-3">Contact Information</h3>
                        <ul class="space-y-2 text-gray-600">
                            <li>Phone: (555) 123-MEDS</li>
                            <li>Email: pharmacy@clinivie.com</li>
                            <li>Address: 123 Health St, Medical District</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>