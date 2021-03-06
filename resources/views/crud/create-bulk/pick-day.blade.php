	<html>
    <head>
		<title>Create Appointments in Bulk</title>
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
		<form method="POST" action="{{ route('logout') }}" id='logout'>
            @csrf
    	</form>
		@include('partials.navigation-bar')
		<div class = "Index_mainDiv">
			<div class = "Index_container nocenter">
				<div class="header-box clearfix">
					<h1><font face="Helvetica">Create Apointments in Bulk</font></h1>
				</div>
				
				<div class='index-filler center-box'>
					<h2>Select a date to get started.</h2>
					<div class='fluffy-box-holder'>
						<input id="date" name="date" type="text">
						<button onclick="window.location+='/' + document.getElementById('date').value" class='fluffy-button'>Submit</button>
					</div>
				</div>
			</div>
		</div>
    </body>
</html>