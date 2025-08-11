<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
@props(['userRole' => auth()->user()->role ?? 'guest', 'apiEndpoint' => '/api/appointments'])

<div id="calendar"></div>

<!-- Booking Modal -->
<div id="bookingModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Book Appointment</h2>
            <span class="close">&times;</span>
        </div>
        
        <form id="bookingForm" class="booking-form">
            <div class="form-group">
                <label for="patientName">Full Name</label>
                <input type="text" id="patientName" name="patientName" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="appointmentDate">Date</label>
                    <input type="date" id="appointmentDate" name="appointmentDate" required readonly>
                </div>

                <div class="form-group">
                    <label for="appointmentTime">Time</label>
                    <select id="appointmentTime" name="appointmentTime" required>
                        <option value="">Select time</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="doctor">Doctor</label>
                <select id="doctor" name="doctor" required>
                    <option value="">Select doctor</option>
                    <option value="Dr. Smith">Dr. Smith - General Practice</option>
                    <option value="Dr. Johnson">Dr. Johnson - Cardiology</option>
                    <option value="Dr. Williams">Dr. Williams - Dermatology</option>
                </select>
            </div>

            <div class="form-group">
                <label for="reason">Reason for Visit</label>
                <textarea id="reason" name="reason" rows="3" required></textarea>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary" id="cancelBtn">Cancel</button>
                <button type="submit" class="btn btn-primary" id="submitBtn">Book Appointment</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    // Load appointments from localStorage
    function loadAppointments() {
        const stored = localStorage.getItem('medical_appointments');
        return stored ? JSON.parse(stored) : [];
    }
    
    // Save appointments to localStorage
    function saveAppointments(appointments) {
        localStorage.setItem('medical_appointments', JSON.stringify(appointments));
    }
    
    // Generate time slots
    const timeSlots = [
        '09:00', '09:30', '10:00', '10:30', '11:00', '11:30',
        '12:00', '12:30', '13:00', '13:30', '14:00', '14:30',
        '15:00', '15:30', '16:00', '16:30', '17:00'
    ];

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        selectable: true,
        selectMirror: true,
        events: function(fetchInfo, successCallback, failureCallback) {
            const appointments = loadAppointments();
            const events = appointments.map(apt => ({
                id: apt.id,
                title: `${apt.patientName} - ${apt.doctor}`,
                start: `${apt.date}T${apt.time}:00`,
                backgroundColor: apt.status === 'cancelled' ? '#ff4d4f' : '#1890ff',
                borderColor: apt.status === 'cancelled' ? '#ff4d4f' : '#1890ff',
                extendedProps: {
                    patientName: apt.patientName,
                    doctor: apt.doctor,
                    reason: apt.reason,
                    status: apt.status
                }
            }));
            successCallback(events);
        },
        dateClick: function(info) {
            // Only allow booking for future dates
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            const clickedDate = new Date(info.date);
            
            if (clickedDate >= today) {
                openBookingModal(info.date);
            }
        },
        eventClick: function(info) {
            const event = info.event;
            const props = event.extendedProps;
            
            alert(`
Patient: ${props.patientName}
Doctor: ${props.doctor}
Time: ${event.start.toLocaleTimeString()}
Reason: ${props.reason}
Status: ${props.status}
            `);
        }
    });

    calendar.render();
    
    // Modal functions
    function openBookingModal(date) {
        const dateString = date.toISOString().split('T')[0];
        document.getElementById('appointmentDate').value = dateString;
        document.getElementById('bookingModal').style.display = 'block';
        updateAvailableTimeSlots();
    }
    
    function closeModal() {
        document.getElementById('bookingModal').style.display = 'none';
        document.getElementById('bookingForm').reset();
    }
    
    function updateAvailableTimeSlots() {
        const doctor = document.getElementById('doctor').value;
        const date = document.getElementById('appointmentDate').value;
        const timeSelect = document.getElementById('appointmentTime');
        
        timeSelect.innerHTML = '<option value="">Select time</option>';
        
        if (!doctor || !date) return;
        
        const appointments = loadAppointments();
        const bookedSlots = appointments
            .filter(apt => apt.doctor === doctor && apt.date === date && apt.status !== 'cancelled')
            .map(apt => apt.time);
        
        timeSlots.forEach(slot => {
            if (!bookedSlots.includes(slot)) {
                const option = document.createElement('option');
                option.value = slot;
                option.textContent = formatTime(slot);
                timeSelect.appendChild(option);
            }
        });
    }
    
    function formatTime(time) {
        const [hours, minutes] = time.split(':');
        const hour = parseInt(hours);
        const ampm = hour >= 12 ? 'PM' : 'AM';
        const displayHour = hour % 12 || 12;
        return `${displayHour}:${minutes} ${ampm}`;
    }
    
    function generateId() {
        return 'apt_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
    }
    
    // Event listeners
    document.querySelector('.close').addEventListener('click', closeModal);
    document.getElementById('cancelBtn').addEventListener('click', closeModal);
    
    document.getElementById('doctor').addEventListener('change', updateAvailableTimeSlots);
    document.getElementById('appointmentDate').addEventListener('change', updateAvailableTimeSlots);
    
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(e.target);
        const appointment = {
            id: generateId(),
            patientName: formData.get('patientName'),
            email: formData.get('email'),
            phone: formData.get('phone'),
            date: formData.get('appointmentDate'),
            time: formData.get('appointmentTime'),
            doctor: formData.get('doctor'),
            reason: formData.get('reason'),
            status: 'booked',
            createdAt: new Date().toISOString()
        };
        
        const appointments = loadAppointments();
        appointments.push(appointment);
        saveAppointments(appointments);
        
        calendar.refetchEvents();
        closeModal();
        
        alert('Appointment booked successfully!');
    });
    
    // Close modal when clicking outside
    window.addEventListener('click', function(e) {
        const modal = document.getElementById('bookingModal');
        if (e.target === modal) {
            closeModal();
        }
    });
});
</script>

<style>
.modal {
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    background-color: white;
    margin: 5% auto;
    padding: 0;
    border-radius: 10px;
    width: 90%;
    max-width: 500px;
    max-height: 90vh;
    overflow-y: auto;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid #eee;
    background: #667eea;
    color: white;
    border-radius: 10px 10px 0 0;
}

.close {
    color: white;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.booking-form {
    padding: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: 600;
    color: #333;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 10px;
    border: 2px solid #e1e5e9;
    border-radius: 5px;
    font-size: 1rem;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #667eea;
}

.form-actions {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
    flex: 1;
}

.btn-primary {
    background: #667eea;
    color: white;
}

.btn-secondary {
    background: #f5f5f5;
    color: #666;
}

.btn:hover {
    opacity: 0.9;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .modal-content {
        width: 95%;
        margin: 10% auto;
    }
}
</style>

</body>
</html>
