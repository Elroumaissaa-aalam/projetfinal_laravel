<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - CLINIVIE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gradient-to-br from-sky-50 via-blue-50 to-indigo-50">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                   
                    <div class="flex items-center space-x-2">
                        <div class="w-10 h-10 bg-gradient-to-br from-sky-500 to-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 8h-2v3h-3v2h3v3h2v-3h3v-2h-3V8zM4 6h5v2h2V6h1V4H4v2zm0 5h7v2H4v-2zm0 3h7v2H4v-2z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-sky-600 to-blue-600 bg-clip-text text-transparent">CLINIVIE</span>
                    </div>

                    <nav class="hidden md:flex space-x-8">
                        <a href="{{ route('welcome') }}" class="text-gray-900 hover:text-sky-600 font-medium transition-colors">Home</a>
                        <a href="{{ route('about') }}" class="text-gray-700 hover:text-sky-600 font-medium transition-colors">About Us</a>
                        <a href="{{ route('welcome') }}#services" class="text-gray-700 hover:text-sky-600 font-medium transition-colors">Services</a>
                        <a href="{{ route('welcome') }}#contact" class="text-gray-700 hover:text-sky-600 font-medium transition-colors">Contact</a>
                    </nav>

                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-sky-600 font-medium transition-colors px-4 py-2">
                            Log In
                        </a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-sky-500 to-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:from-sky-600 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg">
                            Sign Up
                        </a>
                    </div>

                    <div class="md:hidden">
                        <button id="mobile-menu-button" class="text-gray-700 hover:text-sky-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div id="mobile-menu" class="hidden md:hidden pb-4">
                    <div class="space-y-2">
                        <a href="{{ route('welcome') }}" class="block text-gray-900 hover:text-sky-600 font-medium py-2">Home</a>
                        <a href="{{ route('welcome') }}#services" class="block text-gray-700 hover:text-sky-600 font-medium py-2">Services</a>
                        <a href="{{ route('pharmacy') }}" class="block text-gray-700 hover:text-sky-600 font-medium py-2">Pharmacy</a>
                        <a href="{{ route('welcome') }}#contact" class="block text-gray-700 hover:text-sky-600 font-medium py-2">Contact</a>
                        <div class="flex flex-col space-y-2 pt-4 border-t border-gray-200">
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-sky-600 font-medium py-2">Log In</a>
                            <a href="{{ route('register') }}" class="bg-gradient-to-r from-sky-500 to-blue-600 text-white px-4 py-2 rounded-lg font-medium text-center">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <div class="flex justify-center mb-6">
                        <img src="https://www.svgrepo.com/show/331984/hospital-building.svg" alt="Hospital" class="w-24 h-24">
                    </div>
                    <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6">
                        About 
                        <span class="bg-gradient-to-r from-sky-600 to-blue-600 bg-clip-text text-transparent">CLINIVIE</span>
                    </h1>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        A Heritage in Care. A Reputation in Excellence.
                    </p>
                </div>

                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Mission</h2>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            At CLINIVIE, we are dedicated to providing comprehensive healthcare management solutions 
                            that enhance the quality of care for patients while streamlining operations for healthcare providers.
                        </p>
                        <p class="text-gray-600 mb-8 leading-relaxed">
                            Our platform connects patients, doctors, nurses, and administrators in a seamless digital ecosystem 
                            designed to improve healthcare outcomes and patient satisfaction.
                        </p>
                    </div>

                    <div class="bg-white/90 rounded-2xl shadow-xl p-8 border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 text-sky-600 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 8h-2v3h-3v2h3v3h2v-3h3v-2h-3V8zM4 6h5v2h2V6h1V4H4v2zm0 5h7v2H4v-2zm0 3h7v2H4v-2z"/>
                            </svg>
                            Our Services
                        </h3>
                        <div class="space-y-6">
                            <div class="border-l-4 border-sky-500 pl-6 py-2">
                                <h4 class="font-semibold text-gray-900 mb-1">Appointment Management</h4>
                                <p class="text-gray-600 text-sm">Easy scheduling and calendar integration</p>
                            </div>
                            <div class="border-l-4 border-green-500 pl-6 py-2">
                                <h4 class="font-semibold text-gray-900 mb-1">Medical Records</h4>
                                <p class="text-gray-600 text-sm">Secure digital health records</p>
                            </div>
                            <div class="border-l-4 border-blue-500 pl-6 py-2">
                                <h4 class="font-semibold text-gray-900 mb-1">Prescription Management</h4>
                                <p class="text-gray-600 text-sm">Digital prescriptions and medication tracking</p>
                            </div>
                            <div class="border-l-4 border-purple-500 pl-6 py-2">
                                <h4 class="font-semibold text-gray-900 mb-1">Test Results</h4>
                                <p class="text-gray-600 text-sm">Quick access to lab results and reports</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p>&copy; {{ date('Y') }} CLINIVIE. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>