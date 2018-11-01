<!doctype html>

<html>
    <head>
        <title>Appointment Management</title>
        <link href='../fullcalendar.css' rel='stylesheet' />
        <script src='../js/moment.min.js'></script>
        <script src='../js/jquery.min.js'></script>
        <script src='../js/fullcalendar.js'></script>

        <script>

            $(document).ready(function() {

                $('#calendar').fullCalendar({
                    header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listWeek'
                    },
                    defaultDate: '2018-10-31',
                    navLinks: true, // can click day/week names to navigate views
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                });
            });

        </script>
    </head>
    <body>
        <div id='calendar'></div>
    </body>
</html>