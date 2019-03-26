<!doctype html>
<html>
<head>
  <title>Default Configurations</title>
  <link rel = "stylesheet" href = "{{ asset('css/styleMichael.css') }}">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>
<body class = "Index_body">
  <?php
    if(session()->has('timeLogicErrors')) {
      $hasTle = true;
    } else {
      $hasTle = false;
    }
  ?>
  
  <form method="POST" action="{{ route('logout') }}" id='logout'>
    @csrf
  </form>

  @include('partials.navigation-bar')

  <div class = "Index_mainDiv">
    <div class = "Index_container" style='text-align:left;'>

      <!--Div for Title and Image-->
      <div class = "header" style='text-align:center;'>
        <h1 class="defaultconfig_h1"><font face="Helvetica">Hours and Availability</font></h1>
        <br>
      </div>

      <!--Input Elements-->
      <div class="config_div">
        <div style="width:60%;margin:auto;">
          <h2>Current hours and availability as of {{$currentADate->effective_date}}</h2>
          @component('components.hours-summary', ['a' => $currentADate->availability]); @endcomponent

          <h2 style="margin-top:2em;">Last 100 changes to hours and availability</h2>
          @foreach($allADates as $aDate)
            <div style="width:100%;margin-bottom:3em;" class='clearfix'>
              <div style="width:20%;float:left;">
                  <p style="margin-top:0px;">Availability and hours starting on <b>{{$aDate->effective_date}}</b></p>
                  <button onclick="window.location='delete-change/{{$aDate->id}}'">Delete</button>
              </div>
              <div style="width:78%;float:right;">
                  @component('components.hours-summary', ['a' => $aDate->availability]); @endcomponent
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

</body>
</html>
