<!doctype html>
<!--
PROJECT: Appointment MANAGER
PAGE: Appointment.html
LAST UPDATE: 11/05/2018-->
<html lang="en">
<!--Beginning of body-->
<head>
  <title>Appointment Status</title>
  <!--Link to CSS-->
  <link rel = "stylesheet" href = "{{ asset('css/styleMichael.css') }}">

</head>
<!--Beginning of body-->
<body class = "Index_body">
  <!--Autosubmited forms-->
  <form id='checkIn' method='POST' action='/appointments/check-in'>
    @csrf
    <input type='hidden' name='id' value='{{ $appt->Appointment_ID }}'>
  </form>
  <form id='cancel' method='POST' action='/appointments/cancel'>
    @csrf
    <input type='hidden' name='id' value='{{ $appt->Appointment_ID }}'>
  </form>

  <div class="Appointment_Body">
    <h1 class="Appointment_Header"><font face="Helvetica">APPOINTMENT INFORMATION</font></h1>
    <div class="Appointment_Form">

    <b>Appointment Date: </b><b class="Appointment_Time"><input type="text" id="date" name="date" value='{{ $appt->Appointment_Date }}' readonly /></b>

      <br><br>
      <form name="frm">
        <!-- First Name Textbox-->
        <b>First Name: </b>
        <input type = "text"
        id = "First_Name"
        disabled
        style="width: 139px;"
        value="{{ $appt->Client->First_Name }}"/>
        <br><br>
        <!--Last Name Textbox-->
        <b>Last Name: </b>
        <input type = "text"
        disabled
        id = "Last_Name"
        value="{{ $appt->Client->Last_Name }}"/>
        <br><br>
        <!--Phone Number Textbox-->
        <b>Phone Number: </b>
        <input type = "text"
        id = "Phone_Number"
        disabled
        style="width: 110px;"
        value="{{ $appt->client->Phone_Number }}"/>
        <br><br>

        <!--Senior Box Eligibility-->
        <b>Senior Box?</b>
        <br>
        <input type="text" id="SB_Eligibility" style="width: 100px" disabled />
        <br><br>


        <!--buttons-->
        <input type="submit" value="Reschedule Appointment">
        <input type="submit" value="Go Back">
      </form>

      <button onclick="document.forms.namedItem('checkIn').submit()">Check-In</button>
      <button onclick="document.forms.namedItem('cancel').submit()">Cancel</button>
    </div>
  </div>
</body>
</html>