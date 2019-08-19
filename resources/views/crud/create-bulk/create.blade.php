	<html>
    <head>
		<title>Create Appointments in Bulk</title>
		<link href="{{ asset('css/style.css') }}" rel='stylesheet' />
    </head>
	<body class = "Index_body">
		<?php $slotNum = 0; ?>
		<form method="POST" action="{{ route('logout') }}" id='logout'>
            @csrf
    	</form>
		@include('partials.navigation-bar')
		<div class = "Index_mainDiv">
			<div class = "Index_container nocenter">
				<div class="header-box clearfix">
					<h1><font face="Helvetica">Create Apointments for {{$date}}</font></h1>
				</div>

				@if (count($apptDateTimes) == 0)
					<div class="index-filler center-box">
						<h2>Least of These is closed this day.</h2>
						<p style='margin: 40px 0px 10px 0px;'>But that's ok! You can go back and pick a new date.</p>
						<p class='fluffy-button'><a href="{{ url()->previous()}}">Go Back</a></p>
					</div>
				@else

				@if (session()->has('validationErrors'))
					<p class="success center">There were problems with some of your appointments. But don't worry, they are easy to fix! </p>
					<p class="success center">Just go back through this form, read the red text, and make any needed corrections. When you are done, hit submit again at the bottom.</p>
					<p class="success center">All other appointments were created successfully!</p>
				@endif
				
				<form method="POST">
					@csrf
					<?php $slotNum = 0; ?>

					@foreach($apptDateTimes as $adt)
					<h3 class="underline">Appointments at {{$adt->format('g:iA')}}</h3>
					<div class='tab'>
						<table class='spacing-table col5'>

							@for($i=0; $i<$apptsPerSlot; $i++)
								<?php
									if (session()->has('validationErrors')) {
										if (array_key_exists($slotNum, session()->get('validationErrors'))) {
											echo '<tr><td colspan="5">';
											foreach (session()->get('validationErrors')[$slotNum] as $valError) {
												echo '<p class="error">'.$valError.'</p>';
											}
											echo '</td></tr>';
										} else {
											$slotNum += 1;
											continue;
										}
									}
								?>

								<tr>
									<td><input type="text" placeholder="First Name" name="First_Name[{{$slotNum}}]" value="{{old('First_Name')[$slotNum]}}"></td>
									<td><input type="text" placeholder="Last Name" name="Last_Name[{{$slotNum}}]" value="{{old('Last_Name')[$slotNum]}}"></td>
									<td><input type="text" placeholder="Phone Number" name="Phone_Number[{{$slotNum}}]" value="{{old('Phone_Number')[$slotNum]}}"></td>
									<td><input type="text" placeholder="Notes" name="Appointment_Note[{{$slotNum}}]" value="{{old('Appointment_Note')[$slotNum]}}"></td>
									<td>
										<label>Senior Box?</label>
										<input type="checkbox" name="Senior_Box[{{$slotNum}}]" @if (array_key_exists($slotNum, old("Senior_Box", []))) checked @endif>
									</td>
									<input type="hidden" name="Appointment_Date[{{$slotNum}}]" value="{{$adt->format('Y-m-d')}}">
									<input type="hidden" name="Appointment_Time[{{$slotNum}}]" value="{{$adt->format('H:i:s')}}">
									<input type="hidden" name="True_Slot_Number[{{$slotNum}}]" value="{{$slotNum}}">
								</tr>
								<?php $slotNum += 1; ?>
							@endfor

						</table>
					</div>
					@endforeach
					<div class="center-box">
						<div class='fluffy-button-holder' style='margin-top: 30px;'>
							<p>Click here, when you are finished:</p>
							<input type="Submit" value="Submit" class="fluffy-button">
						</div>
					</div>
				</form>

				@endif
			</div>
		</div>
    </body>
</html>