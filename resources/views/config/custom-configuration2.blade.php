<!doctype html>
<!--
PROJECT: Appointment MANAGER
PAGE: Index.html
LAST UPDATE: 11/05/2018-->
<html>
<!--Beginning of header-->
<head>
  <title>Custom Configurations</title>
  <link rel = "stylesheet" href = "{{ asset('css/styleMichael.css') }}">

  <!--Javascript for calendar-->
  <meta charset="utf-8">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#endDate" ).datepicker();
  } );
  $( function() {
    $( "#begingDate" ).datepicker();
  } );
  </script>
</head>
<!--Beginning of body-->
<body class = "Index_body">
  <form method="POST" action="{{ route('logout') }}" id='logout'>
    @csrf
  </form>
  @include('partials.navigation-bar')
  <div class = "Index_mainDiv">
    <div class = "Index_container">

      <!--Div for Title and Image-->
      <div class = "header">
        <h1 class="defaultconfig_h1"><font face="Helvetica">CUSTOM CONFIGURATIONS</font></h1>
        <br>
      </div>

      <!--Input Elements-->
      <div class="config_div">
        <!--Date-->
        <label for="date_range"><b><u>Date Range:</u></b></label><br>
        <b>Beginning: </b><input id="startDate" type="text" />
        <b>End: </b><input id="endDate" type="text" />
        <br><br>
        <table style="width:100%">
            <form id='config' method='POST'>
                @csrf
                <tr>
                  <th>WEEKDAY</th>
                  <th>OPEN</th>
                  <th>CLOSE</th>
                  <th>AVAILABLE INTERVIEWERS</th>
                  <th>OTHER</th>
                </tr>
                <?php $dayNum = 0; ?>
                @foreach(['Sunday', 'Monday', 'Tuesday', 'Wednessday', 'Thursday', 'Friday', 'Saturday'] as $weekday)
                  <tr id='day{{$dayNum}}'>
                    <input type='hidden' name='dayNum[{{$dayNum}}]' value='{{ $dayNum }}'>
                    <td>{{$weekday}}</td>
    
                    <td>
                    <select name='openHour[{{ $dayNum }}]' class='dayInput{{$dayNum}}'>
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
                    </select>
    
                    <b>:</b>
                    <select name='openMinute[{{ $dayNum }}]' class='dayInput{{$dayNum}}'>
                      <option value="00">00</option>
                      <option value="15">15</option>
                      <option value="30">30</option>
                      <option value="45">45</option>
                    </select>
                    <select name='openAmpm[{{ $dayNum }}]' class='dayInput{{$dayNum}}'>
                      <option value="AM">AM</option>
                      <option value="PM">PM</option>
                    </select></td>
                    <td>
                      <select name='closeHour[{{ $dayNum }}]' class='dayInput{{$dayNum}}' class='dayInput{{$dayNum}}'>
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
                      </select>
                        <b>:</b>
                        <select name='closeMinute[{{ $dayNum }}]' class='dayInput{{$dayNum}}'>
                          <option value="00">00</option>
                          <option value="15">15</option>
                          <option value="30">30</option>
                          <option value="45">45</option>
                        </select>
                        <select name='closeAmpm[{{ $dayNum }}]' class='dayInput{{$dayNum}}'>
                          <option value="AM">AM</option>
                          <option value="PM">PM</option>
                        </select>
                      </td>
                      <td>
                        <input type="text" placeholder="Enter Amount" name="numOfVol[{{ $dayNum }}]" class='dayInput{{$dayNum}}' value='1' required>
                      </td>
                      <td>
                        <input type="radio" name="isOpen[{{ $dayNum }}]" value="1"> Open<br>
                        <input type="radio" name="isOpen[{{ $dayNum }}]" value="0"> Closed<br>
                      </td>
                      <script>
                        //TODO: Fix this unholy mess.
                        $('.dayInput{{$dayNum}}').prop('disabled', ($("input[name='isOpen[{{$dayNum}}]']:checked").val() == 0))
                        $("input[name='isOpen[{{$dayNum}}]']").on('change', function() {
                          $('.dayInput{{$dayNum}}').prop('disabled', ($("input[name='isOpen[{{$dayNum}}]']:checked").val() == 0))
                        })
                      </script>
                  </tr>
                  <?php $dayNum+=1 ?>
                @endforeach
              </form>
       </table>
       <br><br>
       <input type="submit" value="Submit">
       <input type="Submit" value="Cancel">
       <br><br>
      </div>
    </div>
  </div>

  <script>
    $('#endDate').on('change', function() {
      var startDate = new Date($('#startDate').value);
      var endDate = new Date($('#endDate').value);

      
    })
  </script>
</body>
</html>
