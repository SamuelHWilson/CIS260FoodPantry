<!doctype html>
<!--
PROJECT: Appointment MANAGER
PAGE: client.html
LAST UPDATE: 11/05/2018-->
<html lang="en">
<!--Beginning of body-->
<head>
  <title>Access Denied</title>
  <!--Link to CSS-->
  <link rel = "stylesheet" href = "{{ asset('css/styleMichael.css') }}">

</head>
<!--Beginning of body-->
<body class = "Index_body">
  <div class="Appointment_Body">
    <h1 class="Appointment_Header"><font face="Helvetica">ACCESS DENIED</font></h1>
    <div class="Appointment_Form">

      <p><b>Changes cannot be make while you are logged in under "View Only".</b></p>
      <p>In order to make changes you will need to select "Logout" below and log in under "View and Modify Appointments".</p>
      <p>If you have reached this page in error, please select "Cancel" below.</p><br>
      <input type="submit" value="Logout">
      <input type="submit" value="Cancel">


    </div>
  </div>
</body>
</html>
