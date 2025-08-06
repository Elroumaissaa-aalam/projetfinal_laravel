<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - CLINIVIE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <a href="{{ route('welcome') }}" class="flex items-center space-x-2">
                        <div class="w-10 h-10 bg-gradient-to-br from-sky-500 to-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 8h-2v3h-3v2h3v3h2v-3h3v-2h-3V8zM4 6h5v2h2V6h1V4H4v2zm0 5h7v2H4v-2zm0 3h7v2H4v-2z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-sky-600 to-blue-600 bg-clip-text text-transparent">CLINIVIE</span>
                    </a>
                </div>

                <!-- Secure Payment Badge -->
                <div class="flex items-center space-x-2 text-green-600">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm font-medium">Secure Payment</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Payment Section -->
    <section class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Complete Your Appointment Booking</h1>
                <p class="text-gray-600">Secure payment to confirm your appointment</p>
            </div>

            @if (session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Appointment Summary -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Appointment Summary</h2>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                            <span class="text-gray-600">Doctor</span>
                            <span class="font-semibold text-gray-900">Dr. {{ $appointment->doctor->name }}</span>
                        </div>
                        
                        @if($appointment->doctor->specialization)
                        <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                            <span class="text-gray-600">Specialization</span>
                            <span class="font-semibold text-gray-900">{{ $appointment->doctor->specialization }}</span>
                        </div>
                        @endif
                        
                        <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                            <span class="text-gray-600">Service</span>
                            <span class="font-semibold text-gray-900">{{ $serviceDetails['name'] }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                            <span class="text-gray-600">Date</span>
                            <span class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('l, F j, Y') }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                            <span class="text-gray-600">Time</span>
                            <span class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                            <span class="text-gray-600">Duration</span>
                            <span class="font-semibold text-gray-900">{{ $serviceDetails['duration'] }} minutes</span>
                        </div>
                        
                        @if($appointment->notes)
                        <div class="pb-4 border-b border-gray-200">
                            <span class="text-gray-600 block mb-2">Notes</span>
                            <span class="text-gray-900">{{ $appointment->notes }}</span>
                        </div>
                        @endif
                        
                        <div class="flex justify-between items-center pt-4">
                            <span class="text-lg font-semibold text-gray-900">Total</span>
                            <span class="text-2xl font-bold text-sky-600">${{ $serviceDetails['price'] }}</span>
                        </div>
                    </div>

                    <!-- Payment Security Info -->
                    <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-2 mb-2">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm font-semibold text-gray-900">Secure Payment</span>
                        </div>
                        <p class="text-xs text-gray-600">
                            Your payment information is encrypted and secure. We use Stripe for secure payment processing.
                        </p>
                    </div>
                </div>

                <!-- Payment Form -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Payment Information</h2>
                    
                    <form id="payment-form">
                        <div id="payment-element" class="mb-6">
                            <!-- Stripe Elements will create form elements here -->
                        </div>
                        
                        <div class="mb-6">
                            <div class="flex items-start">
                                <input id="terms" type="checkbox" class="rounded border-gray-300 text-sky-600 shadow-sm focus:ring-sky-500 mt-1" required>
                                <label for="terms" class="ml-3 text-sm text-gray-700">
                                    I agree to the <a href="#" class="text-sky-600 hover:text-sky-800 underline">Terms of Service</a> 
                                    and <a href="#" class="text-sky-600 hover:text-sky-800 underline">Privacy Policy</a>. 
                                    I understand that this appointment requires payment to confirm booking.
                                </label>
                            </div>
                        </div>
                        
                        <button id="submit-payment" class="w-full btn-primary py-4 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 disabled:opacity-50">
                            <span id="button-text">Pay ${{ $serviceDetails['price'] }} & Confirm Appointment</span>
                            <span id="loading" class="hidden">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Processing...
                            </span>
                        </button>
                        
                        <div id="payment-message" class="hidden mt-4 p-4 rounded-lg"></div>
                    </form>

                    <!-- Cancel Option -->
                    <div class="mt-6 text-center">
                        <a href="{{ route('appointments.calendar') }}" class="text-gray-600 hover:text-gray-800 text-sm">
                            ← Back to Calendar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="flex items-center justify-center space-x-2 mb-4">
                <div class="w-8 h-8 bg-gradient-to-br from-sky-500 to-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 8h-2v3h-3v2h3v3h2v-3h3v-2h-3V8zM4 6h5v2h2V6h1V4H4v2zm0 5h7v2H4v-2zm0 3h7v2H4v-2z"/>
                    </svg>
                </div>
                <span class="text-xl font-bold">CLINIVIE</span>
            </div>
            <p class="text-gray-400 text-sm">
                © {{ date('Y') }} CLINIVIE. All rights reserved. | Secure payment processing by Stripe.
            </p>
        </div>
    </footer>

    <script>
        // Initialize Stripe
        const stripe = Stripe('{{ config("services.stripe.key") }}');
        const options = {
            clientSecret: '{{ $paymentIntent->client_secret }}',
            appearance: {
                theme: 'stripe',
                variables: {
                    colorPrimary: '#0ea5e9',
                    colorBackground: '#ffffff',
                    colorText: '#1f2937',
                    colorDanger: '#ef4444',
                    fontFamily: 'Inter, system-ui, sans-serif',
                    spacingUnit: '4px',
                    borderRadius: '12px',
                }
            }
        };

        // Set up Stripe.js and Elements to use in checkout form
        const elements = stripe.elements(options);

        // Create and mount the Payment Element
        const paymentElement = elements.create('payment');
        paymentElement.mount('#payment-element');

        // Handle form submission
        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit-payment');
        const buttonText = document.getElementById('button-text');
        const loading = document.getElementById('loading');

        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            // Disable the submit button to prevent multiple submissions
            submitButton.disabled = true;
            buttonText.classList.add('hidden');
            loading.classList.remove('hidden');

            try {
                const {error} = await stripe.confirmPayment({
                    elements,
                    confirmParams: {
                        return_url: '{{ route("appointments.payment") }}',
                    },
                    redirect: 'if_required'
                });

                if (error) {
                    // Show error to customer
                    showMessage(error.message, 'error');
                    submitButton.disabled = false;
                    buttonText.classList.remove('hidden');
                    loading.classList.add('hidden');
                } else {
                    // Payment succeeded
                    // Submit form to process payment
                    const confirmForm = document.createElement('form');
                    confirmForm.method = 'POST';
                    confirmForm.action = '{{ route("appointments.payment") }}';
                    
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    
                    const appointmentId = document.createElement('input');
                    appointmentId.type = 'hidden';
                    appointmentId.name = 'appointment_id';
                    appointmentId.value = '{{ $appointment->id }}';
                    
                    const paymentIntentId = document.createElement('input');
                    paymentIntentId.type = 'hidden';
                    paymentIntentId.name = 'payment_intent_id';
                    paymentIntentId.value = '{{ $paymentIntent->id }}';
                    
                    confirmForm.appendChild(csrfToken);
                    confirmForm.appendChild(appointmentId);
                    confirmForm.appendChild(paymentIntentId);
                    
                    document.body.appendChild(confirmForm);
                    confirmForm.submit();
                }
            } catch (err) {
                showMessage('An unexpected error occurred. Please try again.', 'error');
                submitButton.disabled = false;
                buttonText.classList.remove('hidden');
                loading.classList.add('hidden');
            }
        });

        function showMessage(messageText, type = 'error') {
            const messageContainer = document.getElementById('payment-message');
            messageContainer.textContent = messageText;
            messageContainer.classList.remove('hidden', 'bg-red-100', 'bg-green-100', 'text-red-700', 'text-green-700', 'border-red-400', 'border-green-400');
            
            if (type === 'error') {
                messageContainer.classList.add('bg-red-100', 'text-red-700', 'border', 'border-red-400');
            } else {
                messageContainer.classList.add('bg-green-100', 'text-green-700', 'border', 'border-green-400');
            }
        }
    </script>
</body>
</html> 