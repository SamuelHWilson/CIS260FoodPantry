<!doctype html>
<html lang = "en">
	<head>
		<title>REPORTS PAGE</title>	
		<link href="{{ asset('css/style.css') }}" rel='stylesheet' />
	</head>
	<body>
		<div class="page">
			<h2 style="text-align: center;">{{$reportTitle}}</h2>
			<table style = "width: 100%">
				<tr>
					<th>CLIENT NAME</th>
					<th>PHONE NUMBER</th>
					<th>SENIOR BOX</th>
				</tr>
				@foreach($clients as $client)
				<tr>
					<td>{{ $client->First_Name.' '.$client->Last_Name }}</td>
					<td>{{ $client->Phone_Number }}</td>
					<td>{{ $client->SB_Eligibility ? 'YES' : 'NO' }}</td>
				</tr>
				@endforeach
			</table>
			<div style="text-align: center">
				<button class="repButton" onclick='window.print()'>Print</button>
				<button class="repButton" onclick='location.href="/reporting/reports"'>Go Back</button>
			</div>
		</div>
	</body>
</html>