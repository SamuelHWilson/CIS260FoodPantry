<html>
    <head>
		<title>Reports</title>
		<link href="{{ asset('css/style.css') }}" rel='stylesheet' />
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script>
			$( function() {
				$( "#date" ).datepicker({ dateFormat: 'yy-mm-dd' });
			} );
			$( function() {
				$( "#date2" ).datepicker({ dateFormat: 'yy-mm-dd' });
			} );
	  </script>
    </head>
	<body class = "Index_body">
		<form method="POST" action="{{ route('logout') }}" id='logout'>
            @csrf
    	</form>
		@include('partials.navigation-bar')
		<div class = "Index_mainDiv">
			<div class = "Index_container clearfix">
			
				<div>
					<h1 class="defaultconfig_h1"><font face="Helvetica">REPORTS</font></h1>
				</div>
				
				<div class = "left">
					<h2>FREQUENT NO-CALL NO-SHOW REPORT</h2>
					<div style = "text-align: center;">
						<button class = "button" onclick='location.href="/reporting/no-shows"'>View Frequent No-Shows</button>
					</div>
					<br><br>
					<h2>FREQUENT RESCHEDULE REPORT</h2>
					<div style = "text-align: center;">
						<button class = "button" onclick='location.href="/reporting/reschedules"'>View Frequent Appointment Reschedulers</button>
					</div>
				</div>
				<div class = "right">
					<h2>CLIENTS BY DAY REPORT</h2>								
					<div style = "text-align: center;">
						<b>Date: </b><input id="date" type="text" />
						<button class = "button" onclick='location.href="/reporting/daily-clients/" + document.getElementById("date").value'>View Daily Schedule</button>
					</div>
					<br><br>
					<h2>APPOINTMENTS BY DAY REPORT</h2>								
					<div style = "text-align: center;">
						<b>Date: </b><input id="date2" type="text" />
						<button class = "button" onclick='location.href="/reporting/daily-appointments/" + document.getElementById("date2").value'>View Daily Schedule</button>
					</div>
				</div>
			</div>
		</div>
    </body>
</html>