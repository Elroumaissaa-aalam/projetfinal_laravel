<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <rect x="3" y="7" width="18" height="13" rx="2" fill="#e0f2fe"/>
                <rect x="7" y="3" width="10" height="4" rx="1" fill="#bae6fd"/>
                <path d="M12 11v4M10 13h4" stroke="#2563eb" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <h2 class="font-semibold text-2xl text-blue-800 leading-tight">
                Nurse Dashboard
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 dark:bg-gray-800/90 overflow-hidden shadow-xl rounded-2xl p-8 flex flex-col items-center">
                <img src="https://www.svgrepo.com/show/331984/hospital-building.svg" alt="Hospital" class="w-24 h-24 mb-4">
                <h3 class="text-2xl font-bold mb-2 bg-gradient-to-r from-sky-600 to-blue-600 bg-clip-text text-transparent text-center">Welcome, {{ $user->name }}!</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4 text-center">This is your nurse dashboard.</p>
                <div class="flex flex-wrap gap-6 justify-center mt-6">
                    <div class="bg-gradient-to-br from-blue-100 to-green-100 dark:from-gray-700 dark:to-gray-800 rounded-xl shadow p-6 w-64 flex flex-col items-center">
                        <svg class="w-10 h-10 text-blue-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="4" fill="#bae6fd"/>
                            <rect x="6" y="14" width="12" height="6" rx="3" fill="#2563eb"/>
                        </svg>
                        <span class="font-semibold text-lg">Nurse Panel</span>
                        <span class="text-gray-500 text-sm">Manage your tasks</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
