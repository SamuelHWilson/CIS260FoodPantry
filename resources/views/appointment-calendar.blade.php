<!doctype html>

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
                    if (eventObj.url) {
                        alert(
                        'Clicked ' + eventObj.title + '.\n' +
                        'Will open ' + eventObj.url
                        );

                        window.location(eventObj.url);

                        return false;
                    } else {
                        alert('Clicked ' + eventObj.title);
                    }
                },
                header: {
                left: 'previous addAppointment',
                center: 'title',
                right: 'nextView forward'
                },
                customButtons: {
                    addAppointment: {
                        text: 'add appointment',
                        click: function() {
                            alert('This will open appointment creation page')
                        }
                    },
                    nextView: {
                        text: 'Go to {{ $view == "day" ? "Month" : "Day" }} View',
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
                    }
                },
                defaultView: '{{ $view == "day" ? "agendaDay" : "month" }}',
                defaultDate: '{{ $currentDate }}',
                allDaySlot: false,
                navLinks: false,
                nowIndicator: true,
                slotEventOverlap: false,
                aspectRatio: 2,
                slotDuration: '00:15:00',
                minTime: '06:00:00',
                maxTime: '20:00:00',
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
        <ul>
            <li><a class="active" href="#calendar">Calendar</a></li>
            <li><a href="#reports">Reports</a></li>
            <li><a href="#settings">Settings</a></li>
            <li style="float:right"><a href="#lock">Lock Page</a></li>
        </ul>
            <div id='calendar'></div>
    </body>
</html>