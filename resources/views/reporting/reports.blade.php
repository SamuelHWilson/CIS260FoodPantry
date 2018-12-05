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
	  </script>
    </head>
	<body class = "Index_body">
		<div class = "Index_mainDiv">
			<div class = "Index_container">
			
				<div>
					<h1 class="defaultconfig_h1"><font face="Helvetica">REPORTS</font></h1>
				</div>
				
				<div class = "left">
					<h2>SELECT HOW TO GENERATE NO-SHOW REPORT</h2>
					<div style = "text-align: center;">
						<button class = "button" onclick='location.href="/reporting/no-shows"'>View Frequent No-Shows</button>
						<button class = "button" onclick='location.href="/"'>Print Frequent No-Shows</button>
					</div>
				</div>
				<div class = "clear">
					<h2>SELECT DATE AND HOW TO GENERATE DAILY SCHEDULE REPORT</h2>								
					<div style = "text-align: center;">
						<b>Date: </b><input id="date" type="text" />
						<button class = "button" onclick='location.href="/reporting/daily/" + document.getElementById("date").value'>View Daily Schedule</button>
						<button class = "button" onclick='location.href="/reporting/daily/"'>Print Daily Schedule</button>
					</div>
				</div>
			</div>
		</div>
    </body>
</html>