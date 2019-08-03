	<html>
    <head>
		<title>Create Appointments in Bulk</title>
		<link href="{{ asset('css/style.css') }}" rel='stylesheet' />
    </head>
	<body class = "Index_body">
		<form method="POST" action="{{ route('logout') }}" id='logout'>
            @csrf
    	</form>
		@include('partials.navigation-bar')
		<div class = "Index_mainDiv">
			<div class = "Index_container">
				<div class="header-box clearfix">
					<div class="left"><h1><font face="Helvetica">Create Apointments in Bulk</font></h1></div>
					<div class="right">
						<input id="date" name="date" type="text" display="inline">
						<button onclick="window.location+='/' + document.getElementById('date').value">Submit</button>
					</div>
				</div>

				<p class='shy-index-filler'>Select a date to get started...</p>
			</div>
		</div>
    </body>
</html>