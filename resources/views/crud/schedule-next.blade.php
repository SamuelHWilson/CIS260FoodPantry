<html>
    <head>

    </head>
    <body>
        <form method='POST' action='/appointments/create-pending'>
            @csrf
            <input type='hidden' name='clientID' value="{{ $client->Client_ID }}">
            <input type='hidden' name='jumpDate' value="+1 month">
        </form>

        <a href='/'>Home</a>
        <button onclick='document.forms[0].submit()'>Reschedule for {{ $client->First_Name." ".$client->Last_Name }}</button>
    </body>
</html>