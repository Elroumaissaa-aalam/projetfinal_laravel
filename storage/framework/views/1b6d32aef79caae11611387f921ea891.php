<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['userRole' => auth()->user()->role ?? 'guest', 'apiEndpoint' => '/api/appointments']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['userRole' => auth()->user()->role ?? 'guest', 'apiEndpoint' => '/api/appointments']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="calendar-container bg-white rounded-lg shadow-lg p-6">
    <div id="calendar"></div>


    <div id="eventModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-md w-full p-6">
                <h3 id="modalTitle" class="text-lg font-semibold mb-4">Event Details</h3>
                <form id="eventForm">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" id="eventId" name="event_id">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" id="eventTitle" name="title"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Date</label>
                            <input type="datetime-local" id="eventDate" name="date"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Duration (minutes)</label>
                            <input type="number" id="eventDuration" name="duration" value="30"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" id="closeModal"
                            class="px-4 py-2 text-gray-600 hover:text-gray-800">Cancel</button>
                        <button type="button" id="deleteEvent"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 hidden">Delete</button>
                        <button type="submit" id=""
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
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
                initialDate: new Date(), 
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                height: 'auto',
                selectable: this.userRole === 'patient', 
                editable: this.canEditEvents(),
                eventResizableFromStart: true,
                eventDurationEditable: true,
                dayMaxEvents: true, 
                nowIndicator: true, 

                events: (fetchInfo, successCallback, failureCallback) => {
                    this.fetchEvents(fetchInfo, successCallback, failureCallback);
                },

                select: (info) => this.handleDateSelect(info),
                eventClick: (info) => this.handleEventClick(info),
                eventDrop: (info) => this.handleEventDrop(info),
                eventResize: (info) => this.handleEventResize(info),
                dateClick: (info) => this.handleDateClick(info), 

                eventDidMount: (info) => {
                    // Add tooltips
                    info.el.setAttribute('title', this.getEventTooltip(info.event));
                }
            });

            this.calendar.render();
        }

        async fetchEvents(fetchInfo, successCallback, failureCallback) {
            try {
                const response = await fetch(
                    `${this.apiEndpoint}?start=${fetchInfo.startStr}&end=${fetchInfo.endStr}`, {
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
                'scheduled': '#3b82f6', // Blue
                'confirmed': '#10b981', // Green  
                'completed': '#6b7280', // Gray
                'cancelled': '#ef4444', // Red
                'consultation': '#0ea5e9', // Light Blue
                'surgery': '#dc2626', // Dark Red
                'checkup': '#059669', // Dark Green
                'pending': '#f59e0b', // Orange
                'new': '#8b5cf6' // Purple
            };
            return colors[status] || '#6b7280'; // Default gray
        }

        canCreateEvents() {
            return this.userRole === 'patient'; 
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
            if (this.userRole === 'patient') {
                this.openTimeSlotModal(info.start);
            }
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

            this.showTimeSlots(info.date);
        }

        async showTimeSlots(selectedDate) {
            try {
                const dayStart = new Date(selectedDate);
                dayStart.setHours(0, 0, 0, 0);
                const dayEnd = new Date(selectedDate);
                dayEnd.setHours(23, 59, 59, 999);

                
                const events = this.calendar.getEvents().filter(ev => {
                    const evDate = new Date(ev.start);
                    return evDate >= dayStart && evDate <= dayEnd;
                });

              
                const timeSlots = this.generateTimeSlots();

            
                const availableSlots = timeSlots.filter(slot => {
                
                    const [hour, minute] = slot.split(':');
                    const slotStart = new Date(selectedDate);
                    slotStart.setHours(parseInt(hour), parseInt(minute), 0, 0);
                    const slotEnd = new Date(slotStart);
                    slotEnd.setMinutes(slotEnd.getMinutes() + 30);

  
                    return !events.some(ev => {
                        const evStart = new Date(ev.start);
                        const evEnd = ev.end ? new Date(ev.end) : new Date(evStart.getTime() + 30 *
                            60000);
                        return (slotStart < evEnd && slotEnd > evStart); // overlap
                    });
                });

               
                this.createTimeSlotModal(selectedDate, availableSlots);
            } catch (error) {
                console.error('Error showing time slots:', error);
                this.showNotification('Failed to load time slots', 'error');
            }
        }

        generateTimeSlots() {
            const slots = [];
            const startHour = 9; 
            const endHour = 17; 

            for (let hour = startHour; hour < endHour; hour++) {
                slots.push(`${hour.toString().padStart(2, '0')}:00`);
                slots.push(`${hour.toString().padStart(2, '0')}:30`);
            }

            return slots;
        }

        createTimeSlotModal(selectedDate, timeSlots) {
        
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
        `
        ;

            document.body.appendChild(modal);

       
            const timeSlotBtns = modal.querySelectorAll('.time-slot-btn');
            const confirmBtn = modal.querySelector('#confirmTimeSlot');
            let selectedTime = null;

            timeSlotBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                
                    timeSlotBtns.forEach(b => b.classList.remove('bg-blue-500', 'text-white'));

                 
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
            const appointmentData = {
                start: `${selectedDate.toISOString().split('T')[0]}T${selectedTime}`,
                end: this.calculateEndTime(selectedDate, selectedTime),
                title: 'New Appointment',
                duration_minutes: 30,
                status: 'scheduled',
                type: 'consultation' 
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

        async createEvent(eventData) {
            try {
                
                const appointmentData = {
                    ...eventData,
                    status: eventData.status || 'scheduled', 
                    type: eventData.type || 'consultation'
                };

                const response = await fetch(this.apiEndpoint, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify(appointmentData)
                });

                if (response.ok) {
                    const newEvent = await response.json();
                    this.calendar.addEvent(this.formatEvent(newEvent));
                    this.showNotification('Appointment created successfully', 'success');
                } else {
                    throw new Error('Failed to create appointment');
                }
            } catch (error) {
                console.error('Error creating event:', error);
                this.showNotification('Failed to create appointment', 'error');
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
         
            console.log(`${type.toUpperCase()}: ${message}`);
        }
    }

    
    document.addEventListener('DOMContentLoaded', function() {
        window.authUserId = <?php echo e(auth()->id() ?? 'null'); ?>;

        new MedicalCalendar({
            userRole: '<?php echo e($userRole); ?>',
            apiEndpoint: '<?php echo e($apiEndpoint); ?>'
        });
    });
</script>
<?php /**PATH C:\Users\offh0\Desktop\clinivie\resources\views/components/medical-calendar.blade.php ENDPATH**/ ?>