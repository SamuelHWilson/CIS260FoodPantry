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
			<div class = "Index_container nocenter">
				<div class="header-box clearfix">
					<h1><font face="Helvetica">Create Apointments in Bulk</font></h1>
				</div>
				
				<div class='index-filler'>
					<div class="center-box">
						<h2 class="success">Success!</h2>
						<p class="success"><strong>All appointments were created successfully.</strong></p>
					</div>
				</div>
			</div>
		</div>
    </body>
</html>