<html>
    <head>
		<title>Client Information</title>
		<link href="{{ asset('css/style.css') }}" rel='stylesheet' />
    </head>
	<body class = "Index_body">
		<form method="POST" action="{{ route('logout') }}" id='logout'>
            @csrf
    	</form>
		@include('partials.navigation-bar')
		<div class = "Index_mainDiv">
			<div class = "Index_container nocenter clearfix">
				<div class="header-box clearfix">
					<h1><font face="Helvetica">Client Information</font></h1>
				</div>

				<div style="width: 50%; float: left; padding-left: 30px;">
					<div style='display: inline-block;'>
						<h2 class='underline'>Name</h2>
						<p class='size-1'>{{$client->First_Name.' '.$client->Last_Name}}</p>
						<h2 class='underline'>Phone Number</h2>
						<p class='size-1'>{{$client->Phone_Number}}</p>
						<h2 class='underline'>Details</h2>
						@if ($client->SB_Eligibility == true)
							<p class='size-1'>This client is eligable for senior boxes.</p>
						@else
							<p class='size-1'>This client is not eligable for senior boxes.</p>
						@endif
						<div class='center-box' style='margin-top: 5px;'><p class='fluffy-button'><a>Edit Information</a></p></div>

						<h2 class='underline'>Recent Notes</h2>
						<div class='scroll-box' style='max-height: 120px;'>
							@foreach ($appts as $appt)
								@if ($appt->Appointment_Note != null)
									<div class='fluffy-summary'><p>{{$appt->Appointment_Note}}</p></div>
								@endif
							@endforeach
						</div>
					</div>
				</div>
				
				<div style="width: 50%; float: right;">
				</div>
			</div>
		</div>
    </body>
</html>