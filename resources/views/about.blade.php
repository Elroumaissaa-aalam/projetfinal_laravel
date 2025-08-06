<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - CLINIVIE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gradient-to-br from-sky-50 to-blue-100">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <div class="flex items-center">
                        <h1 class="text-2xl font-bold text-sky-600">CLINIVIE</h1>
                    </div>
                    <nav class="flex space-x-8">
                        <a href="{{ route('welcome') }}" class="text-gray-700 hover:text-sky-600">Home</a>
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-sky-600">Login</a>
                        <a href="{{ route('register') }}" class="bg-sky-600 text-white px-4 py-2 rounded-lg hover:bg-sky-700">Register</a>
                    </nav>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">About CLINIVIE</h1>
                    <p class="text-xl text-gray-600">A Heritage in Care. A Reputation in Excellence.</p>
                </div>

                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Mission</h2>
                        <p class="text-gray-600 mb-4">
                            At CLINIVIE, we are dedicated to providing comprehensive healthcare management solutions 
                            that enhance the quality of care for patients while streamlining operations for healthcare providers.
                        </p>
                        <p class="text-gray-600 mb-6">
                            Our platform connects patients, doctors, nurses, and administrators in a seamless digital ecosystem 
                            designed to improve healthcare outcomes and patient satisfaction.
                        </p>
                        
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-sky-600 rounded-full mr-3"></div>
                                <span class="text-gray-700">24/7 Patient Support</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-sky-600 rounded-full mr-3"></div>
                                <span class="text-gray-700">Secure Medical Records</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-sky-600 rounded-full mr-3"></div>
                                <span class="text-gray-700">Integrated Communication</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-xl p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Our Services</h3>
                        <div class="space-y-4">
                            <div class="border-l-4 border-sky-600 pl-4">
                                <h4 class="font-semibold text-gray-900">Appointment Management</h4>
                                <p class="text-gray-600 text-sm">Easy scheduling and calendar integration</p>
                            </div>
                            <div class="border-l-4 border-sky-600 pl-4">
                                <h4 class="font-semibold text-gray-900">Medical Records</h4>
                                <p class="text-gray-600 text-sm">Secure digital health records</p>
                            </div>
                            <div class="border-l-4 border-sky-600 pl-4">
                                <h4 class="font-semibold text-gray-900">Prescription Management</h4>
                                <p class="text-gray-600 text-sm">Digital prescriptions and medication tracking</p>
                            </div>
                            <div class="border-l-4 border-sky-600 pl-4">
                                <h4 class="font-semibold text-gray-900">Test Results</h4>
                                <p class="text-gray-600 text-sm">Quick access to lab results and reports</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p>&copy; {{ date('Y') }} CLINIVIE. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>