<!doctype html>

<html>
    <head>
        <title>Calendar</title>
        <meta charset='utf-8' />
        <link href='..css/fullcalendar.css' rel='stylesheet' />
        <link href='..css/style.css' rel='stylesheet' />
        <script src='..js/moment.min.js'></script>
        <script src='..js/jquery.min.js'></script>
        <script src='..js/fullcalendar.js'></script>

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
                left: 'prev,next today addEvent',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
                },
                customButtons: {
                    addEvent: {
                        text: 'add appointment',
                        click: function() {
                            alert('This will open appointment creation page')
                        }
                    }
                },
                defaultView: 'agendaDay',
                allDaySlot: false,
                navLinks: true,
                aspectRatio: 2,
                slotDuration: '00:15:00',
                minTime: '06:00:00',
                maxTime: '20:00:00',
                slotLabelInterval: '01:00',
                defaultTimedEventDuration: '00:15:00',
                allDayDefault: false,
                eventLimit: true,
                events: [
                    {
                    title: 'Appointment',
                    start: '2018-11-09 08:30:00',
                    url: 'https://www.google.com/',
                    },
                    {
                    title: 'Appointment',
                    start: '2018-11-09 08:30:00'
                    },
                ]
                });
            });
        </script>
    </head>
    <body>
        <ul>
            <li><a class="active" href="#calendar">Calendar</a></li>
            <li><a href="#news">Reports</a></li>
            <li><a href="#settings">Settings</a></li>
            <li style="float:right"><a href="#lock">Lock Page</a></li>
        </ul>
            <div id='calendar'></div>
    </body>
</html>