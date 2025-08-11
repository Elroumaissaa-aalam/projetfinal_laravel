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

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: function(fetchInfo, successCallback, failureCallback) {
            const today = new Date();
            const eventDate = new Date(
                today.getFullYear(),
                today.getMonth(),
                today.getDate(),
                16, 
                0
            );

            
            const events = [
                {
                    title: 'Rourou ',
                    start: eventDate,
                    allDay: false
                }
            ];

            successCallback(events);
        }
    });

    calendar.render();
});
</script>

</body>
</html>