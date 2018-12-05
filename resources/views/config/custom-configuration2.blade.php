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
        <b>Beginning: </b><input id="begingDate" type="text" />
        <b>End: </b><input id="endDate" type="text" />
        <br><br>
        <table style="width:100%">
         <tr>
           <th>WEEKDAY</th>
           <th>OPEN</th>
           <th>CLOSE</th>
           <th>AVAILABLE INTERVIEWERS</th>
           <th>OTHER</th>
         </tr>
         <tr>
           <td>Sunday</td>
           <td>
           <select>
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
           <select>
             <option value="00">00</option>
             <option value="30">30</option>
           </select>
           <select>
             <option value="AM">AM</option>
             <option value="PM">PM</option>
           </select></td>
           <td>
             <select>
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
              <select>
               <option value="00">00</option>
               <option value="30">30</option>
              </select>
              <select>
               <option value="AM">AM</option>
               <option value="PM">PM</option>
              </select>
            </td>
            <td>
              <input type="text" placeholder="Enter Amount" name="av_interviews" required>
            </td>
            <td>
              <input type="radio" name="openclosedSunday" value="open"> Open<br>
              <input type="radio" name="openclosedSunday" value="closed"> Closed<br>
            </td>
         </tr>
         <tr>
           <td>Monday</td>
           <td>
           <select>
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
           <select>
             <option value="00">00</option>
             <option value="30">30</option>
           </select>
           <select>
             <option value="AM">AM</option>
             <option value="PM">PM</option>
           </select></td>
           <td>
             <select>
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
              <select>
               <option value="00">00</option>
               <option value="30">30</option>
              </select>
              <select>
               <option value="AM">AM</option>
               <option value="PM">PM</option>
              </select>
            </td>

            <td>
              <input type="text" placeholder="Enter Amount" name="av_interviews" required>
            </td>
            <td>
              <input type="radio" name="openclosedMonday" value="open"> Open<br>
              <input type="radio" name="openclosedMonday" value="closed"> Closed<br>
            </td>
         </tr>

         <tr>
           <td>Tuesday</td>
           <td>
           <select>
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
           <select>
             <option value="00">00</option>
             <option value="30">30</option>
           </select>
           <select>
             <option value="AM">AM</option>
             <option value="PM">PM</option>
           </select></td>
           <td>
             <select>
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
              <select>
               <option value="00">00</option>
               <option value="30">30</option>
              </select>
              <select>
               <option value="AM">AM</option>
               <option value="PM">PM</option>
              </select>
            </td>
            <td>
              <input type="text" placeholder="Enter Amount" name="av_interviews" required>
            </td>
            <td>
              <input type="radio" name="openclosedTuesday" value="open"> Open<br>
              <input type="radio" name="openclosedTuesday" value="closed"> Closed<br>
            </td>
         </tr>
         <tr>
           <td>Wednesday</td>
           <td>
           <select>
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
           <select>
             <option value="00">00</option>
             <option value="30">30</option>
           </select>
           <select>
             <option value="AM">AM</option>
             <option value="PM">PM</option>
           </select></td>
           <td>
             <select>
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
              <select>
               <option value="00">00</option>
               <option value="30">30</option>
              </select>
              <select>
               <option value="AM">AM</option>
               <option value="PM">PM</option>
              </select>
            </td>
            <td>
              <input type="text" placeholder="Enter Amount" name="av_interviews" required>
            </td>
            <td>
              <input type="radio" name="openclosedWednesday" value="open"> Open<br>
              <input type="radio" name="openclosedWednesday" value="closed"> Closed<br>
            </td>
         </tr>


         <tr>
           <td>Thursday</td>
           <td>
           <select>
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
           <select>
             <option value="00">00</option>
             <option value="30">30</option>
           </select>
           <select>
             <option value="AM">AM</option>
             <option value="PM">PM</option>
           </select></td>
           <td>
             <select>
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
              <select>
               <option value="00">00</option>
               <option value="30">30</option>
              </select>
              <select>
               <option value="AM">AM</option>
               <option value="PM">PM</option>
              </select>
            </td>
            <td>
              <input type="text" placeholder="Enter Amount" name="av_interviews" required>
            </td>
            <td>
              <input type="radio" name="openclosedThursday" value="open"> Open<br>
              <input type="radio" name="openclosedThursday" value="closed"> Closed<br>
            </td>
         </tr>
         <tr>
           <td>Friday</td>
           <td>
           <select>
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
           <select>
             <option value="00">00</option>
             <option value="30">30</option>
           </select>
           <select>
             <option value="AM">AM</option>
             <option value="PM">PM</option>
           </select></td>
           <td>
             <select>
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
              <select>
               <option value="00">00</option>
               <option value="30">30</option>
              </select>
              <select>
               <option value="AM">AM</option>
               <option value="PM">PM</option>
              </select>
            </td>
            <td>
              <input type="text" placeholder="Enter Amount" name="av_interviews" required>
            </td>
            <td>
              <input type="radio" name="openclosedFriday" value="open"> Open<br>
              <input type="radio" name="openclosedFriday" value="closed"> Closed<br>
            </td>
         </tr>
         <tr>
           <td>Saturday</td>
           <td>
           <select>
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
           <select>
             <option value="00">00</option>
             <option value="30">30</option>
           </select>
           <select>
             <option value="AM">AM</option>
             <option value="PM">PM</option>
           </select></td>
           <td>
             <select>
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
              <select>
               <option value="00">00</option>
               <option value="30">30</option>
              </select>
              <select>
               <option value="AM">AM</option>
               <option value="PM">PM</option>
              </select>
            </td>
            <td>
              <input type="text" placeholder="Enter Amount" name="av_interviews" required>
            </td>
            <td>
              <input type="radio" name="openclosedSaturday" value="open"> Open<br>
              <input type="radio" name="openclosedSaturday" value="closed"> Closed<br>
            </td>
         </tr>
       </table>
       <br><br>
       <input type="submit" value="Submit">
       <input type="Submit" value="Cancel">
       <br><br>
      </div>
    </div>
  </div>

</body>
</html>
