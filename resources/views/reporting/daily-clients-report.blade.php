<!doctype html>
<html lang = "en">
	<head>
		<title>REPORTS PAGE</title>	
		<link href="{{ asset('css/style.css') }}" rel='stylesheet' />
	</head>
	<body>
		<div class="page">
			<h2 style="text-align: center;">ALL CLIENTS WITH APPOINTMENTS ON {{ $date }}</h2>
			<table style = "width: 100%">
				<tr>
					<th>CLIENT NAME</th>
				</tr>
				@foreach($clients as $client)
				<tr>
					<td>{{ $client->First_Name.' '.$client->Last_Name }}</td>
				</tr>
				@endforeach
			</table>
			<div style="text-align: center">
				<button class="repButton" onclick='window.print()'>Print</button>
				<button class="repButton" onclick='location.href="/reporting/reports"'>Go Back</button>
				<?php $seniorURL = route("clientSBReport", ["date" => $date]) ?>
				<button class="repButton" onclick='location.href="{{$seniorURL}}"'>Senior Box Only</button>
			</div>
		</div>
	</body>
</html>