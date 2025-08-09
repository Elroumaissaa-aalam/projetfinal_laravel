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
  
    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            
                <div class="lg:col-span-2">
                    <div class="flex items-center space-x-2 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-sky-500 to-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 8h-2v3h-3v2h3v3h2v-3h3v-2h-3V8zM4 6h5v2h2V6h1V4H4v2zm0 5h7v2H4v-2zm0 3h7v2H4v-2z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold">CLINIVIE</span>
                    </div>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        At CLINIVIE, we are committed to providing exceptional healthcare services with compassion, 
                        innovation, and excellence. Your health is our priority.
                    </p>
                    <div class="flex space-x-4">
                     
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-sky-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-sky-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-sky-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-sky-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.347-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24c6.624 0 11.99-5.367 11.99-11.987C24.007 5.367 18.641.001 12.017.001z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-6">Quick Links</h3>
                    <ul class="space-y-3">
                        <li><a href="#home" class="text-gray-300 hover:text-white transition-colors">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#services" class="text-gray-300 hover:text-white transition-colors">Services</a></li>
                        <li><a href="#appointment" class="text-gray-300 hover:text-white transition-colors">Book Appointment</a></li>
                        <li><a href="#contact" class="text-gray-300 hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>

             
                <div>
                    <h3 class="text-lg font-semibold mb-6">Policies</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Cookie Policy</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Patient Rights</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Billing Information</a></li>
                    </ul>
                </div>
            </div>

         
            <div class="border-t border-gray-800 mt-12 pt-8 text-center">
                <p class="text-gray-400">
                    © {{ date('Y') }} CLINIVIE. All rights reserved. | Designed with care for your health.
                </p>
            </div>
        </div>
    </footer>
    </div>
</body>
</html>