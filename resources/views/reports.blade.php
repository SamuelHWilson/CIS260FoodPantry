<html>
    <head>
		<title>Reports</title>
		<link href="{{ asset('css/style.css') }}" rel='stylesheet' />
    </head>
    <body style = "background-color: #D3D3D3;">
		<ul>
            <li><a href="#calendar">Calendar</a></li>
            <li><a class="active" href="#reports">Reports</a></li>
            <li><a href="#settings">Settings</a></li>
            <li style="float:right"><a href="#lock">Lock Page</a></li>
        </ul>

		<h1 style = "border-bottom: solid; text-align: center;"><font face="Helvetica">Select the report and how you would like it generated</font></h1>
		<div style = "text-align : center">
		    <button style = "background-color: white; color: black; border: 2px solid #555555; font-size: 20px;" onclick='location.href="/"'>View Daily Schedule</button>
		    <button style = "background-color: white; color: black; border: 2px solid #555555; font-size: 20px;" onclick='location.href="/"'>Print Daily Schedule</button>
			<button style = "background-color: white; color: black; border: 2px solid #555555; font-size: 20px;" onclick='location.href="/"'>View Frequent No-Shows</button>
			<button style = "background-color: white; color: black; border: 2px solid #555555; font-size: 20px;" onclick='location.href="/"'>Print Frequent No-Shows</button>
		</div>
    </body>
</html>