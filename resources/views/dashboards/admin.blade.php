<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <rect x="3" y="7" width="18" height="13" rx="2" fill="#e0f2fe"/>
                <rect x="7" y="3" width="10" height="4" rx="1" fill="#bae6fd"/>
                <path d="M12 11v4M10 13h4" stroke="#2563eb" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <h2 class="font-semibold text-2xl text-blue-800 leading-tight">
                Admin Dashboard
            </h2>
        </div>
    </x-slot>
    <div class="flex flex-col items-center mb-8">
        <img src="https://www.svgrepo.com/show/331984/hospital-building.svg" alt="Hospital" class="w-24 h-24 mb-2">
        <h3 class="text-2xl font-bold text-blue-700">Welcome, {{ auth()->user()->name }}!</h3>
        <p class="text-gray-500">Administrator panel for managing the hospital system.</p>
    </div>

    <div class="py-6 bg-gradient-to-br from-sky-50 to-blue-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
            

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
             
             
             
             
             
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-sky-400">
                    <div class="flex items-center">
                        <div class="bg-sky-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Patients</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_patients'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-400">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Doctors</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_doctors'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-cyan-400">
                  
                  
                  
                  
                    <div class="flex items-center">
                        <div class="bg-cyan-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Nurses</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_nurses'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-indigo-400">
                    <div class="flex items-center">
                        <div class="bg-indigo-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Appointments</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_appointments'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                
                <div class="bg-white rounded-xl shadow-md p-6">
                
                
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Today's Appointments</p>
                            <p class="text-3xl font-bold text-sky-600">{{ $stats['appointments_today'] }}</p>
                        </div>
                        <div class="bg-sky-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Pending Tests</p>
                            <p class="text-3xl font-bold text-blue-600">{{ $stats['pending_tests'] }}</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Active Prescriptions</p>
                            <p class="text-3xl font-bold text-cyan-600">{{ $stats['active_prescriptions'] }}</p>
                        </div>
                        <div class="bg-cyan-100 p-3 rounded-full">
                            <svg class="w-8 h-8 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

      

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
          



                <div class="lg:col-span-2">
                  
                  
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="bg-gradient-to-r from-sky-500 to-blue-600 px-6 py-4">
                  
                            <h3 class="text-lg font-semibold text-white">System Management</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <a href="{{ route('admin.users') }}" class="flex items-center p-4 bg-sky-50 rounded-lg hover:bg-sky-100 transition-colors border border-sky-200">
                                    <div class="bg-sky-100 p-3 rounded-full">
                                        <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-sm font-semibold text-gray-900">Manage Users</h4>
                                        <p class="text-xs text-gray-600">Add, edit, delete system users</p>
                                    </div>
                                </a>

                                <a href="{{ route('admin.appointments') }}" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors border border-blue-200">
                                    <div class="bg-blue-100 p-3 rounded-full">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-sm font-semibold text-gray-900">View Appointments</h4>
                                        <p class="text-xs text-gray-600">Monitor all appointments</p>
                                    </div>
                                </a>

                                <a href="{{ route('admin.tests') }}" class="flex items-center p-4 bg-cyan-50 rounded-lg hover:bg-cyan-100 transition-colors border border-cyan-200">
                                    <div class="bg-cyan-100 p-3 rounded-full">
                                        <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              
                              
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                              
                                    <div class="ml-4">
                                        <h4 class="text-sm font-semibold text-gray-900">Medical Tests</h4>
                                        <p class="text-xs text-gray-600">View all test results</p>
                              
                              
                                    </div>
                                </a>

                                <a href="{{ route('admin.prescriptions') }}" class="flex items-center p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors border border-indigo-200">
                              
                              
                                    <div class="bg-indigo-100 p-3 rounded-full">
                                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-sm font-semibold text-gray-900">Prescriptions</h4>
                                        <p class="text-xs text-gray-600">Monitor prescriptions</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

           



                <div class="space-y-6">
                    <div class="bg-white rounded-xl shadow-md p-6">
                      
                      
                      
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <button onclick="document.getElementById('newUserModal').classList.remove('hidden')"
                      
                      
                            class="w-full flex items-center p-3 bg-sky-50 rounded-lg hover:bg-sky-100 transition-colors">
                      
                            <svg class="w-5 h-5 text-sky-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                      
                      
                            </svg>
                      
                      
                            <span class="text-sm font-medium text-gray-700">Add New User</span>
                      
                        </button>
                            <a href="{{ route('admin.settings') }}" class="flex items-center p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                      
                                <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">System Settings</span>
                            </a>
                        </div>
                    </div>

             




                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Users</h3>
                        @if($recentUsers->count() > 0)
                        
                        <div class="space-y-3">
                                @foreach($recentUsers as $user)
                        
                        
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                            <p class="text-xs text-gray-600">{{ ucfirst($user->role) }}</p>
                        
                        
                        
                        
                                        </div>
                                        <span class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-500 text-center py-4">No recent users</p>
                        @endif
                    </div>
                </div>
            </div>





            @if($recentAppointments->count() > 0)
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
            
            
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white">Recent Appointments</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($recentAppointments as $appointment)
            
            
                            <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg border border-blue-200">
                                    <div class="flex items-center space-x-4">
            
                                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-900">
                                                {{ $appointment->patient->name }} → Dr. {{ $appointment->doctor->name }}
                                            </h4>
                                            <p class="text-sm text-gray-600">{{ ucfirst($appointment->type) }}</p>
            
            
                                        </div>
            
                                    </div>
            
                                    <div class="text-right">
            
                                        <p class="text-sm font-medium text-blue-600">
                                            {{ $appointment->appointment_date->format('M d, Y h:i A') }}
            
                                        </p>
            
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
            
                                        {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
            
                                        {{ ucfirst($appointment->status) }}
                                        </span>
                                    </div>
            
                                </div>
                            @endforeach
            
            
            
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>


    <div id="newUserModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">


            <h3 class="text-lg font-semibold text-gray-900 mb-4">Add New User</h3>
            <form action="{{ route('admin.users.create') }}" method="POST" class="space-y-4">

                @csrf

                <div class="grid grid-cols-2 gap-4">

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>

                        <input type="text" name="name" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-sky-500 focus:border-sky-500" required>

                    </div>

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>

                        <select name="role" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-sky-500 focus:border-sky-500" required>
                            <option value="patient">Patient</option>
                            <option value="doctor">Doctor</option>
                            <option value="nurse">Nurse</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-sky-500 focus:border-sky-500" required>
                </div>
               
               
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-sky-500 focus:border-sky-500" required>
               
                </div>
               
               
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <input type="tel" name="phone" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-sky-500 focus:border-sky-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">License Number</label>
                        <input type="text" name="license_number" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-sky-500 focus:border-sky-500">
                    </div>
               
               
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="document.getElementById('newUserModal').classList.add('hidden')"
                            class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-sky-600 text-white rounded-lg hover:bg-sky-700">Create User</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout> 