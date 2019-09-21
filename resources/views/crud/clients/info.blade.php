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

		<script>
			function EnableEdit() {
				document.getElementById('client-info').style.display = 'none';
				document.getElementById('client-edit').style.display = 'block';
			}
		</script>

		<div class = "Index_mainDiv">
			<a href='{{route("searchClient")}}' style='position: absolute; bottom: 15px; left: 20px;'><p class='fluffy-button'>Return to Search</p></a>
			<div class = "Index_container nocenter clearfix">
				<div class="header-box clearfix">
					<h1><font face="Helvetica">Client Information</font></h1>
				</div>

				<div style="width: 66%; float: left;" class='clearfix'>
					<div style="width: 48%; float: left; padding: 0% 1%;">
						<div id='client-info'>
							<h2 >Name</h2>
							<p class='size-1'>{{$client->First_Name.' '.$client->Last_Name}}</p>
							<h2 >Phone Number</h2>
							<p class='size-1'>{{$client->Phone_Number}}</p>
							<h2 >Details</h2>
							@if ($client->SB_Eligibility == true)
								<p class='size-1'>This client is eligable for senior boxes.</p>
							@else
								<p class='size-1'>This client is not eligable for senior boxes.</p>
							@endif

							<p class='fluffy-button' style='margin-top: 12px;' onclick='EnableEdit()'>Edit Information</p>
						</div>

						<div id='client-edit' style='display: none;'>
							@if (!$errors->isEmpty()) <script>EnableEdit()</script> @endif

							<form action='{{route("updateClient")}}' method="POST">
								@csrf
								<input type='hidden' name='Client_ID' value={{$client->Client_ID}}>
								<h2 >Name</h2>
								<input class='fluffy-input' name='First_Name' value='{{old("First_Name") ? old("First_Name") : $client->First_Name}}' style='width: 45%; margin: 0% 3%;'>
								<input class='fluffy-input' name='Last_Name' value='{{old("Last_Name") ? old("Last_Name") : $client->Last_Name}}' style='width: 45%;'>
								@if ($errors->has('First_Name')) <p class='error' style='margin-top: 5px;'>The client's first name can only contain letters.</p> @endif
								@if ($errors->has('Last_Name')) <p class='error' style='margin-top: 5px;'>The client's last name can only contain letters.</p> @endif
								<h2 >Phone Number</h2>
								<input class='fluffy-input' name='Phone_Number' value='{{old("Phone_Number") ? old("Phone_Number") : $client->Phone_Number}}' style='width: 45%; margin-left: 3%'>
								@if ($errors->has('Phone_Number')) <p class='error' style='margin-top: 5px;'>The client's phone number must be 10 digits long.</p> @endif								
								<h2 >Details</h2>
								<label class='fluffy-input' for='senior-yes' style='margin: 0% 3%;'><input type='radio' name='SB_Eligibility' value='1' id='senior-yes' @if ((old("SB_Eligibility") ? old("SB_Eligibility") : $client->SB_Eligibility) == 1) checked @endif> Senior Box</label>
								<label class='fluffy-input' for='senior-no'><input type='radio' name='SB_Eligibility' value='0' id='senior-no' @if ((old("SB_Eligibility") ? old("SB_Eligibility") : $client->SB_Eligibility) == 0) checked @endif> No Senior Box</label>
							
								<div class='center-box' style='margin-top: 30px;'><input type='submit' class='fluffy-button confirm' value='Save Information'></div>
							</form>
						</div>
					</div>

					<div style="width: 48%; float: right; padding: 0% 1%;">
						<h2 >Upcoming Appointment</h2>
						@if ($upcomingAppt != null)
							<?php $isProblem = (in_array($upcomingAppt->Appointment_ID, $problemIds))? true : false; ?>
							<div class='fluffy-summary @if($isProblem) problem @endif' col='4' style='width:100%'>
								<div><p>{{$upcomingAppt->Appointment_Date}}</p></div>
								<div><p>{{$upcomingAppt->Appointment_Time}}</p></div>
								<div><p>{{$isProblem ? 'Problem' : $upcomingAppt->Status->Status_Name}}</p></div>
								<div><p class='fluffy-button'><a href={{route('view-appointment', ['id' => $upcomingAppt->Appointment_ID])}}>View</a></p></div>
							</div>
						@else
							<div class='fluffy-summary' style='width:100%'>
								<p>This client does not have any upcoming appointments...</p>
							</div>
						@endif
	
						<h2 >All Appointments</h2>
						<div class='scroll-box' style='height: 275px;'>
							<div class='fluffy-summary header' col='4' style='width:98%'>
								<div><p>Date</p></div>
								<div><p>Time</p></div>
								<div><p>Status</p></div>
								<div><p>Action</p></div>
							</div>
							@foreach ($appts as $appt)
								<?php $isProblem = (in_array($appt->Appointment_ID, $problemIds))? true : false; ?>
								<div class='fluffy-summary @if($isProblem) problem @endif' col='4' style='width:98%'>
									<div><p>{{$appt->Appointment_Date}}</p></div>
									<div><p>{{$appt->Appointment_Time}}</p></div>
									<div><p>{{$isProblem ? 'Problem' : $appt->Status->Status_Name}}</p></div>
									<div class='center-box'><div><p class='fluffy-button'><a href={{route('view-appointment', ['id' => $appt->Appointment_ID])}}>View</a></p></div></div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
				
				<div style="width: 31%; float: right; padding-right: 1%;">
					<h2>Flagged Behavior</h2>
					@if (!$client->Flags->isEmpty())
						@foreach($client->Flags as $flag)
							<div class='fluffy-summary problem'><p>{{$flag->Flag_DES}}</p></div>
						@endforeach
					@else
						<div class='fluffy-summary problem'><p>This client has no flagged behavior...</p></div>
					@endif

					<h2 >Recent Notes</h2>
					<div class='scroll-box' style='height: 225px;'>
						<?php $hasNote = false; ?>
						@foreach ($appts as $appt)
							@if ($appt->Appointment_Note != null)
								<div class='fluffy-summary al'><p>{{$appt->Appointment_Note}}</p></div>
								<?php $hasNote = true; ?>
							@endif
						@endforeach
						@if ($hasNote == false)
							<p class='center' style='padding-top: 12px;'>This client has no recent notes...</p>
						@endif
					</div>
				</div>
			</div>
		</div>
    </body>
</html>