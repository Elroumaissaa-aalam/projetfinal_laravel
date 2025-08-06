@props(['userRole' => auth()->user()->role ?? 'guest', 'apiEndpoint' => '/api/appointments'])

<div class="calendar-container bg-white rounded-lg shadow-lg p-6">
    <div id="calendar"></div>
    
    <!-- Enhanced Event Modal -->
    <div id="eventModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-md w-full p-6">
                <h3 id="modalTitle" class="text-lg font-semibold mb-4">Event Details</h3>
                <form id="eventForm">
                    @csrf
                    <input type="hidden" id="eventId" name="event_id">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" id="eventTitle" name="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Date</label>
                            <input type="datetime-local" id="eventDate" name="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Duration (minutes)</label>
                            <input type="number" id="eventDuration" name="duration" value="30" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" id="closeModal" class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</button>
                        <button type="button" id="deleteEvent" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 hidden">Delete</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script>
class MedicalCalendar {
    constructor(options) {
        this.userRole = options.userRole;
        this.apiEndpoint = options.apiEndpoint;
        this.calendar = null;
        this.currentEvent = null;
        this.init();
    }

    init() {
        this.initCalendar();
        this.bindEvents();
    }

    initCalendar() {
        const calendarEl = document.getElementById('calendar');
        
        this.calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            initialDate: new Date(), // Show current date by default
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            height: 'auto',
            selectable: true, // Allow date selection for all users
            editable: this.canEditEvents(),
            eventResizableFromStart: true,
            eventDurationEditable: true,
            dayMaxEvents: true, // Show more events
            nowIndicator: true, // Show current time indicator
            
            events: (fetchInfo, successCallback, failureCallback) => {
                this.fetchEvents(fetchInfo, successCallback, failureCallback);
            },
            
            select: (info) => this.handleDateSelect(info),
            eventClick: (info) => this.handleEventClick(info),
            eventDrop: (info) => this.handleEventDrop(info),
            eventResize: (info) => this.handleEventResize(info),
            dateClick: (info) => this.handleDateClick(info), // Add date click handler
            
            eventDidMount: (info) => {
                // Add tooltips
                info.el.setAttribute('title', this.getEventTooltip(info.event));
            }
        });

        this.calendar.render();
    }

    async fetchEvents(fetchInfo, successCallback, failureCallback) {
        try {
            const response = await fetch(`${this.apiEndpoint}?start=${fetchInfo.startStr}&end=${fetchInfo.endStr}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });
            
            if (!response.ok) throw new Error('Failed to fetch events');
            
            const data = await response.json();
            const events = data.map(event => this.formatEvent(event));
            successCallback(events);
        } catch (error) {
            console.error('Error fetching events:', error);
            failureCallback(error);
            this.showNotification('Failed to load events', 'error');
        }
    }

    formatEvent(event) {
        return {
            id: event.id,
            title: event.title || `${event.patient_name} - Dr. ${event.doctor_name}`,
            start: event.start || `${event.appointment_date}T${event.appointment_time}`,
            end: event.end,
            backgroundColor: this.getEventColor(event.status || event.type),
            borderColor: this.getEventColor(event.status || event.type),
            extendedProps: {
                ...event,
                canEdit: this.canEditEvent(event),
                canDelete: this.canDeleteEvent(event)
            }
        };
    }

    getEventColor(status) {
        const colors = {
            'scheduled': '#3b82f6',
            'confirmed': '#10b981',
            'completed': '#6b7280',
            'cancelled': '#ef4444',
            'consultation': '#0ea5e9',
            'surgery': '#dc2626',
            'checkup': '#059669'
        };
        return colors[status] || '#6b7280';
    }

    canCreateEvents() {
        return ['doctor', 'nurse', 'admin'].includes(this.userRole);
    }

    canEditEvents() {
        return ['doctor', 'nurse', 'admin'].includes(this.userRole);
    }

    canEditEvent(event) {
        if (this.userRole === 'admin') return true;
        if (this.userRole === 'doctor' && event.doctor_id === window.authUserId) return true;
        if (this.userRole === 'nurse') return true;
        return false;
    }

    canDeleteEvent(event) {
        return this.canEditEvent(event);
    }

    handleDateSelect(info) {
        this.openEventModal('create', {
            start: info.start,
            end: info.end
        });
    }

    handleEventClick(info) {
        this.currentEvent = info.event;
        this.openEventModal('edit', info.event);
    }

    async handleEventDrop(info) {
        await this.updateEvent(info.event.id, {
            start: info.event.start.toISOString(),
            end: info.event.end?.toISOString()
        });
    }

    async handleEventResize(info) {
        await this.updateEvent(info.event.id, {
            start: info.event.start.toISOString(),
            end: info.event.end?.toISOString()
        });
    }

    handleDateClick(info) {
        // Show available time slots for the selected date
        this.showTimeSlots(info.date);
    }

    async showTimeSlots(selectedDate) {
        try {
            // Generate time slots for the selected date
            const timeSlots = this.generateTimeSlots();
            
            // Create modal for time slot selection
            this.createTimeSlotModal(selectedDate, timeSlots);
        } catch (error) {
            console.error('Error showing time slots:', error);
            this.showNotification('Failed to load time slots', 'error');
        }
    }

    generateTimeSlots() {
        const slots = [];
        const startHour = 9; // 9 AM
        const endHour = 17; // 5 PM
        
        for (let hour = startHour; hour < endHour; hour++) {
            slots.push(`${hour.toString().padStart(2, '0')}:00`);
            slots.push(`${hour.toString().padStart(2, '0')}:30`);
        }
        
        return slots;
    }

    createTimeSlotModal(selectedDate, timeSlots) {
        // Remove existing modal if any
        const existingModal = document.getElementById('timeSlotModal');
        if (existingModal) {
            existingModal.remove();
        }

        const modal = document.createElement('div');
        modal.id = 'timeSlotModal';
        modal.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4';
        
        const dateStr = selectedDate.toLocaleDateString();
        
        modal.innerHTML = `
            <div class="bg-white rounded-lg max-w-md w-full p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Select Time for ${dateStr}</h3>
                    <button onclick="this.closest('#timeSlotModal').remove()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="grid grid-cols-3 gap-2 mb-4">
                    ${timeSlots.map(slot => `
                        <button class="time-slot-btn p-2 text-sm border border-gray-300 rounded hover:bg-blue-50 hover:border-blue-500 transition-colors" 
                                data-time="${slot}">
                            ${slot}
                        </button>
                    `).join('')}
                </div>
                <div class="flex justify-end space-x-3">
                    <button onclick="this.closest('#timeSlotModal').remove()" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                        Cancel
                    </button>
                    <button id="confirmTimeSlot" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700" disabled>
                        Confirm
                    </button>
                </div>
            </div>
        `;

        document.body.appendChild(modal);

        // Add event listeners for time slot selection
        const timeSlotBtns = modal.querySelectorAll('.time-slot-btn');
        const confirmBtn = modal.querySelector('#confirmTimeSlot');
        let selectedTime = null;

        timeSlotBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove previous selection
                timeSlotBtns.forEach(b => b.classList.remove('bg-blue-500', 'text-white'));
                
                // Select current button
                btn.classList.add('bg-blue-500', 'text-white');
                selectedTime = btn.dataset.time;
                confirmBtn.disabled = false;
            });
        });

        confirmBtn.addEventListener('click', () => {
            if (selectedTime) {
                this.createAppointment(selectedDate, selectedTime);
                modal.remove();
            }
        });
    }

    async createAppointment(selectedDate, selectedTime) {
        // Create appointment with selected date and time
        const appointmentData = {
            start: `${selectedDate.toISOString().split('T')[0]}T${selectedTime}`,
            end: this.calculateEndTime(selectedDate, selectedTime),
            title: 'New Appointment',
            duration_minutes: 30
        };

        await this.createEvent(appointmentData);
    }

    calculateEndTime(date, time) {
        const [hours, minutes] = time.split(':');
        const endDate = new Date(date);
        endDate.setHours(parseInt(hours), parseInt(minutes) + 30);
        return endDate.toISOString();
    }

    openEventModal(mode, eventData) {
        const modal = document.getElementById('eventModal');
        const form = document.getElementById('eventForm');
        const title = document.getElementById('modalTitle');
        const deleteBtn = document.getElementById('deleteEvent');

        title.textContent = mode === 'create' ? 'Create Event' : 'Edit Event';
        deleteBtn.classList.toggle('hidden', mode === 'create');

        if (mode === 'edit' && eventData) {
            document.getElementById('eventId').value = eventData.id;
            document.getElementById('eventTitle').value = eventData.title;
            document.getElementById('eventDate').value = this.formatDateForInput(eventData.start);
            document.getElementById('eventDuration').value = eventData.extendedProps.duration_minutes || 30;
        } else {
            form.reset();
            document.getElementById('eventDate').value = this.formatDateForInput(eventData.start);
        }

        modal.classList.remove('hidden');
    }

    bindEvents() {
        const modal = document.getElementById('eventModal');
        const form = document.getElementById('eventForm');
        const closeBtn = document.getElementById('closeModal');
        const deleteBtn = document.getElementById('deleteEvent');

        closeBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        deleteBtn.addEventListener('click', async () => {
            if (confirm('Are you sure you want to delete this event?')) {
                await this.deleteEvent(this.currentEvent.id);
                modal.classList.add('hidden');
            }
        });

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            const eventId = formData.get('event_id');

            if (eventId) {
                await this.updateEvent(eventId, Object.fromEntries(formData));
            } else {
                await this.createEvent(Object.fromEntries(formData));
            }
            
            modal.classList.add('hidden');
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    }

    async createEvent(data) {
        try {
            const response = await fetch(`${this.apiEndpoint}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) throw new Error('Failed to create event');
            
            this.calendar.refetchEvents();
            this.showNotification('Event created successfully', 'success');
        } catch (error) {
            console.error('Error creating event:', error);
            this.showNotification('Failed to create event', 'error');
        }
    }

    async updateEvent(id, data) {
        try {
            const response = await fetch(`${this.apiEndpoint}/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) throw new Error('Failed to update event');
            
            this.calendar.refetchEvents();
            this.showNotification('Event updated successfully', 'success');
        } catch (error) {
            console.error('Error updating event:', error);
            this.showNotification('Failed to update event', 'error');
        }
    }

    async deleteEvent(id) {
        try {
            const response = await fetch(`${this.apiEndpoint}/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Failed to delete event');
            
            this.calendar.refetchEvents();
            this.showNotification('Event deleted successfully', 'success');
        } catch (error) {
            console.error('Error deleting event:', error);
            this.showNotification('Failed to delete event', 'error');
        }
    }

    formatDateForInput(date) {
        return new Date(date).toISOString().slice(0, 16);
    }

    getEventTooltip(event) {
        return `${event.title}\nTime: ${event.start.toLocaleString()}\nStatus: ${event.extendedProps.status || 'N/A'}`;
    }

    showNotification(message, type) {
        // Implement your notification system here
        console.log(`${type.toUpperCase()}: ${message}`);
    }
}

// Initialize calendar
document.addEventListener('DOMContentLoaded', function() {
    window.authUserId = {{ auth()->id() ?? 'null' }};
    
    new MedicalCalendar({
        userRole: '{{ $userRole }}',
        apiEndpoint: '{{ $apiEndpoint }}'
    });
});
</script>


