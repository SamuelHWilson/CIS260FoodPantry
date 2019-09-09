<html>
    <head>
		<title>Search Results</title>
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
					<h1><font face="Helvetica">Search Results</font></h1>
				</div>
				
				<div class='center-box' style='margin: 30px 0px;'>
					@include('components.client-search')
				</div>

				<div class='center-box' style='width: 600px;'>
					<div class='scroll-box' style='max-height: 350px;'>
						<div class='fluffy-summary header' col='4'>
							<div><p>First Name</p></div>
							<div><p>Last Name</p></div>
							<div><p>Phone #</p></div>
							<div><p>Action</p></div>
						</div>

						@foreach ($clients as $client)
							<div class='fluffy-summary' col='4'>
								<div><p>{{$client->First_Name}}</p></div>
								<div><p>{{$client->Last_Name}}</p></div>
								<div><p>{{$client->Phone_Number}}</p></div>
								<div><p class='fluffy-button'><a>View</a></p></div>
							</div>
						@endforeach

						@if ($clients->isEmpty()) <p class='error' style='margin: 30px'>No clients were found... Try a different search.</p> @endif
					</div>
				</div>
			</div>
		</div>
    </body>
</html>