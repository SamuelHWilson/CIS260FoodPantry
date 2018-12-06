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
</head>
<!--Beginning of body-->
<body class = "Index_body">
  <div class = "Index_mainDiv">
    <div class = "Index_container">

      <!--Div for Title and Image-->
      <div class = "header">
        <h1 class="defaultconfig_h1"><font face="Helvetica">DEFAULT CONFIGURATIONS</font></h1>
        <br>
        {{ $errors }}
      </div>



      <!--Input Elements-->
      <div class="config_div">
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
            <?php $dayNum = 0;
                  $defCons = $defCons->keyBy('day'); ?>
            @foreach(['Sunday', 'Monday', 'Tuesday', 'Wednessday', 'Thursday', 'Friday', 'Saturday'] as $weekday)
              <?php $day = $defCons[$dayNum]; ?>
              <tr>
                <input type='hidden' name='dayNum' value='{{ $dayNum }}'>
                <td>{{$weekday}}</td>
                <td>
                <select name='openHour[{{ $dayNum }}]'>
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
                  <option value='{{ $day->formatOpenTime("g") }}' selected hidden>{{ $day->formatOpenTime("g") }}</option>
                </select>
                <b>:</b>
                <select name='openMinute[{{ $dayNum }}]'>
                  <option value="00">00</option>
                  <option value="15">15</option>
                  <option value="30">30</option>
                  <option value="45">45</option>
                  <option value='{{ $day->formatOpenTime("i") }}' selected hidden >{{ $day->formatOpenTime("i") }}</option>
                </select>
                <select name='openAmpm[{{ $dayNum }}]'>
                  <option value="AM">AM</option>
                  <option value="PM">PM</option>
                  <option value='{{ $day->formatOpenTime("A") }}' selected hidden>{{ $day->formatOpenTime("A") }}</option>
                </select></td>
                <td>
                  <select name='closeHour[{{ $dayNum }}]'>
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
                    <option value='{{ $day->formatCloseTime("g") }}' selected hidden>{{ $day->formatCloseTime("g") }}</option>  
                  </select>
                    <b>:</b>
                    <select name='closeMinute[{{ $dayNum }}]'>
                      <option value="00">00</option>
                      <option value="15">15</option>
                      <option value="30">30</option>
                      <option value="45">45</option>
                      <option value='{{ $day->formatCloseTime("i") }}' selected hidden>{{ $day->formatCloseTime("i") }}</option>  
                    </select>
                    <select name='closeAmpm[{{ $dayNum }}]'>
                      <option value="AM">AM</option>
                      <option value="PM">PM</option>
                      <option value='{{ $day->formatCloseTime("A") }}' selected hidden>{{ $day->formatCloseTime("A") }}</option>  
                    </select>
                  </td>
                  <td>
                    <input type="text" placeholder="Enter Amount" name="numOfVol[{{ $dayNum }}]" value='{{ $day->numOfVol }}' required>
                  </td>
                  <td>
                    <input type="radio" name="isOpen[{{ $dayNum }}]" @if($day->isOpen) checked @endif value="1"> Open<br>
                    <input type="radio" name="isOpen[{{ $dayNum }}]" @if(!$day->isOpen) checked @endif value="0"> Closed<br>
                  </td>
              </tr>
              <?php $dayNum+=1 ?>
            @endforeach
          </form>
        </table>
        <button type="submit" onclick='forms.namedItem("config").submit()'>Submit</button>
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
