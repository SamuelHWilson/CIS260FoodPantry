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
      </div>

      <!--Input Elements-->
      <div class="Index_login">
        <label for="av_interviews"><b><u>Hours of Operation</u></b></label><br>
        <label for="open"><b>Open: </b></label>
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
        <br><br>
        <label for="close"><b>Close: </b></label>
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
        <br><br>
        <label for="av_interviews"><b><u>Available Interviewers:</u></b></label>
        <input type="text" placeholder="Enter Amount" name="av_interviews" required>
        <br><br>
        <input type="radio" name="openclosed" value="open"> Open<br>
        <input type="radio" name="openclosed" value="closed"> Closed<br>
        <br><br>
        <!--Submit Button-->
        <button type="submit">Save</button>
        <br><br>
        <a href="url">Customize Configurations</a>
      </div>
    </div>
  </div>

</body>
</html>
