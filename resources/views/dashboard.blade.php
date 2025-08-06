<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <rect x="3" y="7" width="18" height="13" rx="2" fill="#e0f2fe"/>
                <rect x="7" y="3" width="10" height="4" rx="1" fill="#bae6fd"/>
                <path d="M12 11v4M10 13h4" stroke="#2563eb" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <h2 class="font-semibold text-2xl text-blue-800 leading-tight">
                Hospital Dashboard
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 dark:bg-gray-800/90 overflow-hidden shadow-xl rounded-2xl p-8 flex flex-col items-center">
                <div class="mb-8">
                    <img src="https://www.svgrepo.com/show/331984/hospital-building.svg" alt="Hospital" class="w-32 h-32 mx-auto mb-4">
                    <h3 class="text-3xl font-bold mb-2 bg-gradient-to-r from-sky-600 to-blue-600 bg-clip-text text-transparent text-center">Welcome to Clinivie Hospital</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4 text-center">Your health and well-being are our highest priorities. Manage appointments, staff, and patients from your dashboard.</p>
                </div>
                <div class="flex flex-wrap gap-6 justify-center mt-6">
                  
                    <div class="bg-gradient-to-br from-blue-100 to-green-100 dark:from-gray-700 dark:to-gray-800 rounded-xl shadow p-6 w-64 flex flex-col items-center">
                        <svg class="w-10 h-10 text-blue-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <rect x="3" y="5" width="18" height="16" rx="2" fill="#e0f2fe"/>
                            <path d="M8 2v4M16 2v4M3 10h18" stroke="#2563eb" stroke-width="2"/>
                            <rect x="9" y="14" width="6" height="4" rx="1" fill="#22c55e"/>
                        </svg>
                        <span class="font-semibold text-lg">Book Appointment</span>
                        <span class="text-gray-500 text-sm">Schedule a new visit</span>
                    </div>
                
                    <div class="bg-gradient-to-br from-blue-100 to-green-100 dark:from-gray-700 dark:to-gray-800 rounded-xl shadow p-6 w-64 flex flex-col items-center">
                        <svg class="w-10 h-10 text-green-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="4" fill="#bbf7d0"/>
                            <rect x="6" y="14" width="12" height="6" rx="3" fill="#22c55e"/>
                        </svg>
                        <span class="font-semibold text-lg">Doctors</span>
                        <span class="text-gray-500 text-sm">View all doctors</span>
                    </div>
               
                    <div class="bg-gradient-to-br from-blue-100 to-green-100 dark:from-gray-700 dark:to-gray-800 rounded-xl shadow p-6 w-64 flex flex-col items-center">
                        <svg class="w-10 h-10 text-blue-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="4" fill="#bae6fd"/>
                            <rect x="6" y="14" width="12" height="6" rx="3" fill="#2563eb"/>
                        </svg>
                        <span class="font-semibold text-lg">Nurses</span>
                        <span class="text-gray-500 text-sm">View all nurses</span>
                    </div>
                  
                    <div class="bg-gradient-to-br from-blue-100 to-green-100 dark:from-gray-700 dark:to-gray-800 rounded-xl shadow p-6 w-64 flex flex-col items-center">
                        <svg class="w-10 h-10 text-green-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <rect x="4" y="8" width="16" height="8" rx="4" fill="#bbf7d0"/>
                            <rect x="10" y="4" width="4" height="4" rx="2" fill="#22c55e"/>
                        </svg>
                        <span class="font-semibold text-lg">Pharmacy</span>
                        <span class="text-gray-500 text-sm">Manage medicines</span>
                    </div>
               
                    <div class="bg-gradient-to-br from-blue-100 to-green-100 dark:from-gray-700 dark:to-gray-800 rounded-xl shadow p-6 w-64 flex flex-col items-center">
                        <svg class="w-10 h-10 text-blue-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="4" fill="#e0f2fe"/>
                            <rect x="6" y="14" width="12" height="6" rx="3" fill="#2563eb"/>
                        </svg>
                        <span class="font-semibold text-lg">Patients</span>
                        <span class="text-gray-500 text-sm">View all patients</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
