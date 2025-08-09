<x-app-layout>
  

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           
            <div class="bg-gradient-to-r from-sky-500 to-blue-600 rounded-lg shadow-lg p-6 text-black mb-6">
                <h1 class="text-3xl font-bold mb-2">Welcome back ss, {{ auth()->user()->name }}!</h1>
         
            </div>

        
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h3 class="text-lg font-semibold mb-4">My Appointments</h3>
                        <x-medical-calendar userRole="patient" apiEndpoint="/api/patient/appointments" />
                    </div>
                </div>

                
                <div class="space-y-6">
                 
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                        
                            <a href="/chatify" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                Chat with Doctor
                            </a>
                        
                        </div>
                    </div>

                  
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Recent Messages</h3>
                        <div class="space-y-3">
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold">
                                    Dr
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium">Dr. Johnson</p>
                                    <p class="text-xs text-gray-500">Your test results are ready</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  
    <div id="paymentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
                <h3 class="text-lg font-semibold mb-4">Payment</h3>
                <div id="payment-element"></div>
                <button id="submit-payment" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 mt-4">
                    Pay Now
                </button>
                <button onclick="closePaymentModal()" class="w-full bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 mt-2">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        function openPaymentModal() {
            document.getElementById('paymentModal').classList.remove('hidden');
           
        }
        
        function closePaymentModal() {
            document.getElementById('paymentModal').classList.add('hidden');
        }
    </script>
</x-app-layout>

