<!doctype html>
<html lang = "en">
	<head>
		<title>REPORTS PAGE</title>	
		<link href="{{ asset('css/style.css') }}" rel='stylesheet' />
	</head>
	<body>
		<div class="page">
			<h2 style="text-align: center;">APPOINTMENTS FOR {{ $date }}</h2>
			<table style = "width: 100%">
				<tr>
					<th>APPOINTMENT TIME</th>
					<th>CLIENT NAME</th>
					<th>PHONE NUMBER</th>
					<th>SENIOR BOX</th>
				</tr>
				@foreach($appointments as $appt)
				<tr>
					<td>{{ date_format(new DateTime($appt->Appointment_Time),'g:ia') }}</td>
					<td>{{ $appt->Client->First_Name.' '.$appt->Client->Last_Name }}</td>
					<td>{{ $appt->Client->Phone_Number }}</td>
					<td>{{ $appt->Client->SB_Eligibility ? 'YES' : 'NO' }}</td>
				</tr>
				@endforeach
			</table>
			<button onclick='window.print()'>Print</button>
		</div>
	</body>
</html>