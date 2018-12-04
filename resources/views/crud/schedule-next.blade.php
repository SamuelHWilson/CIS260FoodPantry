<html>
    <head>
		<title>Reschedule Appointment</title>
    </head>
    <body style = "background-color: #D3D3D3;">
        <form method='POST' action='/appointments/create-pending'>
            @csrf
            <input type='hidden' name='clientID' value="{{ $client->Client_ID }}">
            <input type='hidden' name='jumpString' value="+1 month">
        </form>

		<h1 style = "border-bottom: solid; text-align: center;"><font face="Helvetica">Would you like to schedule next appointment or return to homepage?</font></h1>
		<div style = "text-align : center">
		    <button style = "background-color: white; color: black; border: 2px solid #555555; font-size: 20px;" onclick='document.forms[0].submit()'>Reschedule for {{ $client->First_Name." ".$client->Last_Name }}</button>
			<button style = "background-color: white; color: black; border: 2px solid #555555; font-size: 20px;" onclick='location.href="/"'>Return to homepage</button>
		</div>
    </body>
</html>