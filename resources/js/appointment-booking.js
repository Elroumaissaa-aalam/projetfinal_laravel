class AppointmentBooking {
    constructor() {
        this.form = document.getElementById('bookingForm');
        this.doctorSelect = document.getElementById('doctor_id');
        this.dateInput = document.getElementById('appointment_date');
        this.serviceSelect = document.getElementById('service_type');
        this.bookButton = document.getElementById('bookButton');
        this.priceDisplay = document.getElementById('priceDisplay');
        this.priceAmount = document.getElementById('priceAmount');
        this.timeSlotsContainer = document.getElementById('timeSlotsContainer');
        
        this.init();
    }
    
    init() {
        this.bindEvents();
        this.updatePrice();
        this.checkFormValidity();
    }
    
    bindEvents() {
        if (this.doctorSelect) {
            this.doctorSelect.addEventListener('change', () => this.updateTimeSlots());
        }
        
        if (this.dateInput) {
            this.dateInput.addEventListener('change', () => this.updateTimeSlots());
        }
        
        if (this.serviceSelect) {
            this.serviceSelect.addEventListener('change', () => this.updatePrice());
        }
        
        if (this.form) {
            this.form.addEventListener('submit', (e) => this.handleSubmit(e));
        }
        
        // Listen for time slot changes
        document.addEventListener('change', (e) => {
            if (e.target.name === 'appointment_time') {
                this.checkFormValidity();
            }
        });
    }
    
    async updateTimeSlots() {
        const doctorId = this.doctorSelect?.value;
        const date = this.dateInput?.value;
        
        if (!doctorId || !date) return;
        
        try {
            this.showLoading();
            
            const response = await fetch(`/api/appointments/calendar?doctor_id=${doctorId}&date=${date}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });
            
            if (response.ok) {
                const html = await response.text();
                // Parse the response and update time slots
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newTimeSlots = doc.getElementById('timeSlotsContainer');
                
                if (newTimeSlots && this.timeSlotsContainer) {
                    this.timeSlotsContainer.innerHTML = newTimeSlots.innerHTML;
                }
            }
        } catch (error) {
            console.error('Error updating time slots:', error);
            this.showNotification('Failed to load time slots', 'error');
        } finally {
            this.hideLoading();
            this.checkFormValidity();
        }
    }
    
    updatePrice() {
        if (!this.serviceSelect || !this.priceAmount || !this.priceDisplay) return;
        
        const selectedOption = this.serviceSelect.options[this.serviceSelect.selectedIndex];
        if (selectedOption && selectedOption.dataset.price) {
            this.priceAmount.textContent = '$' + selectedOption.dataset.price;
            this.priceDisplay.classList.remove('hidden');
        } else {
            this.priceDisplay.classList.add('hidden');
        }
        this.checkFormValidity();
    }
    
    checkFormValidity() {
        if (!this.bookButton) return;
        
        const doctorSelected = this.doctorSelect?.value;
        const dateSelected = this.dateInput?.value;
        const serviceSelected = this.serviceSelect?.value;
        const timeSelected = document.querySelector('input[name="appointment_time"]:checked');
        
        const isAuthenticated = document.querySelector('meta[name="user-authenticated"]')?.content === 'true';
        const isValid = doctorSelected && dateSelected && serviceSelected && timeSelected && isAuthenticated;
        
        this.bookButton.disabled = !isValid;
        
        if (isValid) {
            this.bookButton.classList.remove('opacity-50', 'cursor-not-allowed');
            this.bookButton.classList.add('hover:shadow-xl');
        } else {
            this.bookButton.classList.add('opacity-50', 'cursor-not-allowed');
            this.bookButton.classList.remove('hover:shadow-xl');
        }
    }
    
    async handleSubmit(e) {
        e.preventDefault();
        
        if (this.bookButton.disabled) return;
        
        const formData = new FormData(this.form);
        
        try {
            this.setButtonLoading(true);
            
            const response = await fetch(this.form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                this.showNotification(data.message, 'success');
                
                // Redirect after success
                setTimeout(() => {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                }, 2000);
            } else {
                this.showNotification(data.message || 'Booking failed', 'error');
            }
        } catch (error) {
            console.error('Booking error:', error);
            this.showNotification('An error occurred. Please try again.', 'error');
        } finally {
            this.setButtonLoading(false);
        }
    }
    
    setButtonLoading(loading) {
        if (!this.bookButton) return;
        
        if (loading) {
            this.bookButton.disabled = true;
            this.bookButton.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Processing...
            `;
        } else {
            this.bookButton.disabled = false;
            this.bookButton.innerHTML = 'Proceed to Payment';
            this.checkFormValidity();
        }
    }
    
    showLoading() {
        if (this.timeSlotsContainer) {
            this.timeSlotsContainer.innerHTML = `
                <div class="flex items-center justify-center py-8">
                    <svg class="animate-spin h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="ml-2 text-gray-600">Loading time slots...</span>
                </div>
            `;
        }
    }
    
    hideLoading() {
        // Loading will be replaced by updateTimeSlots
    }
    
    showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm transform transition-all duration-300 translate-x-full`;
        
        const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
        notification.classList.add(bgColor, 'text-white');
        
        notification.innerHTML = `
            <div class="flex items-center">
                <span class="flex-1">${message}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => notification.remove(), 300);
        }, 5000);
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new AppointmentBooking();
});

// Export for use in other modules
window.AppointmentBooking = AppointmentBooking;