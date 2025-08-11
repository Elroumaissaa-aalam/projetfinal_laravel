class StripeCheckout {
    constructor(options = {}) {
        this.stripe = null;
        this.elements = null;
        this.paymentElement = null;
        this.options = {
            // Use publishable key from meta tag (set in Blade template)
            publishableKey: document.querySelector('meta[name="stripe-key"]')?.content,
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
            },
            ...options
        };
        this.init();
    }

    async init() {
        if (!this.options.publishableKey) {
            throw new Error('Stripe publishable key not found');
        }
        this.stripe = Stripe(this.options.publishableKey);
        this.bindEvents();
    }

    async createPaymentIntent(data) {
        try {
            const response = await fetch('/api/stripe/payment-intent', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                throw new Error('Failed to create payment intent');
            }

            return await response.json();
        } catch (error) {
            console.error('Payment intent creation failed:', error);
            throw error;
        }
    }

    async setupPaymentForm(clientSecret, containerId = 'payment-element') {
        this.elements = this.stripe.elements({
            clientSecret,
            appearance: this.options.appearance
        });

        this.paymentElement = this.elements.create('payment');
        this.paymentElement.mount(`#${containerId}`);

        // Handle real-time validation errors
        this.paymentElement.on('change', (event) => {
            this.displayError(event.error ? event.error.message : '');
        });
    }

    async processPayment(formData = {}) {
        if (!this.stripe || !this.elements) {
            throw new Error('Stripe not initialized');
        }

        this.setLoading(true);

        try {
            const { error, paymentIntent } = await this.stripe.confirmPayment({
                elements: this.elements,
                confirmParams: {
                    return_url: window.location.origin + '/payment/success',
                    ...formData
                },
                redirect: 'if_required'
            });

            if (error) {
                this.displayError(error.message);
                return { success: false, error };
            }

            if (paymentIntent.status === 'succeeded') {
                await this.handleSuccessfulPayment(paymentIntent);
                return { success: true, paymentIntent };
            }

            return { success: false, error: 'Payment not completed' };
        } catch (error) {
            console.error('Payment processing failed:', error);
            this.displayError('An unexpected error occurred');
            return { success: false, error };
        } finally {
            this.setLoading(false);
        }
    }

    async handleSuccessfulPayment(paymentIntent) {
        // Update appointment status
        try {
            await fetch('/api/appointments/payment-success', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    payment_intent_id: paymentIntent.id,
                    appointment_id: paymentIntent.metadata.appointment_id
                })
            });

            this.showSuccess('Payment successful! Your appointment has been confirmed.');
            
            // Redirect after delay
            setTimeout(() => {
                window.location.href = '/patient/dashboard';
            }, 2000);
        } catch (error) {
            console.error('Failed to update appointment:', error);
        }
    }

    displayError(message) {
        const errorElement = document.getElementById('payment-errors');
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.classList.toggle('hidden', !message);
        }
    }

    showSuccess(message) {
        const successElement = document.getElementById('payment-success');
        if (successElement) {
            successElement.textContent = message;
            successElement.classList.remove('hidden');
        }
    }

    setLoading(isLoading) {
        const submitButton = document.getElementById('submit-payment');
        const spinner = document.getElementById('payment-spinner');
        
        if (submitButton) {
            submitButton.disabled = isLoading;
            submitButton.textContent = isLoading ? 'Processing...' : 'Pay Now';
        }
        
        if (spinner) {
            spinner.classList.toggle('hidden', !isLoading);
        }
    }

    bindEvents() {
        // Handle payment form submission
        const paymentForm = document.getElementById('payment-form');
        if (paymentForm) {
            paymentForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const formData = new FormData(paymentForm);
                const result = await this.processPayment(Object.fromEntries(formData));
                
                if (!result.success) {
                    console.error('Payment failed:', result.error);
                }
            });
        }
    }
}

// Export for use in other modules
window.StripeCheckout = StripeCheckout;
