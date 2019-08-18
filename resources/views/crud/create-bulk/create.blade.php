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
			<div class = "Index_container" style='text-align:left;'>
				<div class="header-box clearfix">
					<h1><font face="Helvetica">Create Apointments for {{$apptDateTimes[0]->format('Y-m-d')}}</font></h1>
				</div>

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
									<input type="hidden" name="Appointment_Time[{{$slotNum}}]" value="{{$adt->format('h:gi')}}">
									<input type="hidden" name="True_Slot_Number[{{$slotNum}}]" value="{{$slotNum}}">
								</tr>
								<?php $slotNum += 1; ?>
							@endfor

						</table>
					</div>
					@endforeach
					<input type="Submit" value="Submit">
				</form>
			</div>
		</div>
    </body>
</html>