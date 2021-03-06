<html>
    <head>
		<title>Manage Clients</title>
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
					<h1><font face="Helvetica">Manage Clients</font></h1>
				</div>
				
				<div class='index-filler center-box'>
					@if ($errors->isEmpty())
						<h2>Search for a client to get started.</h2>
					@else
						<h2>There were problems with your search.</h2>
					@endif
					@include('components.client-search', ['bottomMessages' => true])
				</div>
			</div>
		</div>
    </body>
</html>