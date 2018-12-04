<!doctype html>

<?php
    // session()->forget('pendingAppointment');
    // session()->save();
    // dd(session()->all());
?>

<html>
    <head>
        <title>Calendar</title>
        <meta charset='utf-8' />
        <link href="{{ asset('css/fullcalendar.css') }}" rel='stylesheet' />
        <link href="{{ asset('css/style.css') }}" rel='stylesheet' />
        <script src="{{ asset('js/moment.min.js') }}"></script>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/fullcalendar.js') }}"></script>

        <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                eventClick: function(eventObj) {
                    window.location = '/appointments/view-appointment/' +  eventObj.id
                },
                height: "auto",
                header: {
                    left: 'previous forward currentDate nextView',
                    center: 'title',
                    right: 'addAppointment'
                },
                customButtons: {
                    addAppointment: {
                        text: 'Add Appointment',
                        click: function() {
                            window.location = '/appointments/create-appointment/{{ $currentDate }}'
                        }
                    },
                    nextView: {
                        text: '{{ $view == "day" ? "Month" : "Day" }} View',
                        click: function(){
                            window.location = '../{{ $view == "day" ? "month" : "day" }}-view/{{ $currentDate }}'
                        }
                    },
                    previous: {
                        text: 'Previous {{ ucfirst($view) }}',
                        click: function() {
                            window.location = '../{{ $view }}-view/{{ $prevDate }}'                            
                        }
                    },
                    forward: {
                        text: 'Next  {{ ucfirst($view) }}',
                        click: function(){
                            window.location = '../{{ $view }}-view/{{ $nextDate }}'                            
                        }
                    },
                    currentDate: {
                        text: 'Today',
                        click: function() {
                            window.location = '{{ $currentDate }}';
                        }
                    }
                },
                @if ($view == 'month')
                    dayClick: function(date, jsEvent, view) {
                        window.location = '../day-view/' + date.format()
                    },
                @endif
                defaultView: '{{ $view == "day" ? "agendaDay" : "month" }}',
                defaultDate: '{{ $currentDate }}',
                allDaySlot: false,
                navLinks: false,
                nowIndicator: true,
                slotEventOverlap: false,
                aspectRatio: 2,
                slotDuration: '00:15:00',
                minTime: '{{ $dayConfig->FCMinTime }}',
                maxTime: '{{ $dayConfig->FCMaxTime }}',
                slotLabelInterval: '01:00',
                defaultTimedEventDuration: '00:15:00',
                allDayDefault: false,
                eventLimit: true,
                events: {!! $appointments !!}
                });
            });
        </script>
    </head>
    <body>
        <form method="POST" action="{{ route('logout') }}" id='logout'>
            @csrf
        </form>
        <ul>
            <li><a class="active" href="#calendar">Calendar</a></li>
            <li><a href="#reports">Reports</a></li>
            <li><a href="#settings">Settings</a></li>
            <li style="float:right" onclick='document.forms.namedItem("logout").submit()'><a href="#lock">Lock Page</a></li>
        </ul>
        @include('partials.cancel-pending-appointment')
            <div id='calendar'></div>
    </body>
</html>