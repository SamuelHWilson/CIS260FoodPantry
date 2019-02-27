<!doctype html>
<!--
PROJECT: Appointment MANAGER
PAGE: Index.html
LAST UPDATE: 11/05/2018-->
<html>
<!--Beginning of header-->
<head>
  <title>Default Configurations</title>
  <link rel = "stylesheet" href = "{{ asset('css/styleMichael.css') }}">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>
<!--Beginning of body-->
<body class = "Index_body">
  <?php
    if(session()->has('timeLogicErrors')) {
      $hasTle = true;
      dump(session('timeLogicErrors'));
    } else {
      $hasTle = false;
    }
  ?>
  <form method="POST" action="{{ route('logout') }}" id='logout'>
    @csrf
  </form>
  @include('partials.navigation-bar')
  <div class = "Index_mainDiv">
    <div class = "Index_container">

      <!--Div for Title and Image-->
      <div class = "header">
        <h1 class="defaultconfig_h1"><font face="Helvetica">DEFAULT CONFIGURATIONS</font></h1>
        <br>
      </div>



      <!--Input Elements-->
      <div class="config_div">
        <table style="width:100%">
          <form id='config' method='POST'>
            @csrf
            @if ($errors->has('effective_date')) <p>There is something wrong with this date.</p> @endif
            <label for="effective_date"><b>Starting date for new hours:</b></label><br>
            <b>Beginning: </b><input id="effective_date" name="effective_date" type="text" />
            <br><br>

            <tr>
              <th>WEEKDAY</th>
              <th>OPEN</th>
              <th>CLOSE</th>
              <th>AVAILABLE INTERVIEWERS</th>
              <th>OTHER</th>
            </tr>
            <?php $day_number = 0;
                  //$availability_days = $availability_days->keyBy('day'); --}} ?>
            @foreach(['Sunday', 'Monday', 'Tuesday', 'Wednessday', 'Thursday', 'Friday', 'Saturday'] as $weekday)
              <?php // $day = $availability_days[$day_number]; ?>
              <tr>
                <input type='hidden' name='day_number[{{$day_number}}]' value='{{ $day_number }}'>
                <td>{{$weekday}}</td>

                <td>
                @if($hasTle && in_array($day_number, session('timeLogicErrors'))) <p>This time might be incorrect.</p> @endif
                <select name='openHour[{{ $day_number }}]' class='dayInput{{$day_number}}'>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  
                  {{-- <option value='{{ $day->formatOpenTime("g") }}' selected hidden>{{ $day->formatOpenTime("g") }}</option> --}}
                </select>

                <b>:</b>
                <select name='openMinute[{{ $day_number }}]' class='dayInput{{$day_number}}'>
                  <option value="00">00</option>
                  <option value="15">15</option>
                  <option value="30">30</option>
                  <option value="45">45</option>
                  {{-- <option value='{{ $day->formatOpenTime("i") }}' selected hidden >{{ $day->formatOpenTime("i") }}</option> --}}
                </select>
                <select name='openAmpm[{{ $day_number }}]' class='dayInput{{$day_number}}'>
                  <option value="AM">AM</option>
                  <option value="PM">PM</option>
                  {{-- <option value='{{ $day->formatOpenTime("A") }}' selected hidden>{{ $day->formatOpenTime("A") }}</option> --}}
                </select></td>
                <td>
                @if($hasTle && in_array($day_number, session('timeLogicErrors'))) <p>This time might be incorrect.</p> @endif                    
                  <select name='closeHour[{{ $day_number }}]' class='dayInput{{$day_number}}' class='dayInput{{$day_number}}'>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    {{-- <option value='{{ $day->formatCloseTime("g") }}' selected hidden>{{ $day->formatCloseTime("g") }}</option>   --}}
                  </select>
                    <b>:</b>
                    <select name='closeMinute[{{ $day_number }}]' class='dayInput{{$day_number}}'>
                      <option value="00">00</option>
                      <option value="15">15</option>
                      <option value="30">30</option>
                      <option value="45">45</option>
                      {{-- <option value='{{ $day->formatCloseTime("i") }}' selected hidden>{{ $day->formatCloseTime("i") }}</option>   --}}
                    </select>
                    <select name='closeAmpm[{{ $day_number }}]' class='dayInput{{$day_number}}'>
                      <option value="AM">AM</option>
                      <option value="PM">PM</option>
                      {{-- <option value='{{ $day->formatCloseTime("A") }}' selected hidden>{{ $day->formatCloseTime("A") }}</option>   --}}
                    </select>
                  </td>
                  <td>
                    <input type="text" placeholder="Enter Amount" name="available_staff[{{ $day_number }}]" value='1' class='dayInput{{$day_number}}' required>
                  </td>
                  <td>
                    <input type="radio" name="is_open[{{ $day_number }}]" {{-- @if($day->is_open) checked @endif --}} value="1">Open<br>
                    <input type="radio" name="is_open[{{ $day_number }}]" {{-- @if(!$day->is_open) checked @endif --}} value="0">Closed<br>
                  </td>
                  <script>
                    //TODO: Fix this unholy mess.
                    $('.dayInput{{$day_number}}').prop('disabled', ($("input[name='is_open[{{$day_number}}]']:checked").val() == 0))
                    $("input[name='is_open[{{$day_number}}]']").on('change', function() {
                      $('.dayInput{{$day_number}}').prop('disabled', ($("input[name='is_open[{{$day_number}}]']:checked").val() == 0))
                    })
                  </script>
              </tr>
              <?php $day_number+=1 ?>
            @endforeach
          </form>
        </table>
        <script>
          function workaround() {
            $(':disabled').prop('disabled', false);
            document.forms.namedItem("config").submit()
          }
        </script>
        <button type="submit" onclick='workaround()'>Submit</button>
       <br><br>
       <input type="Submit" value="Cancel">
       <br><br>
        <br><br>
        <a href="url">Customize Configurations</a>
      </div>
    </div>
  </div>

</body>
</html>
