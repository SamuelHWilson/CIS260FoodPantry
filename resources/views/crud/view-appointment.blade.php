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
  <div class="Appointment_Body">
    <h1 class="Appointment_Header"><font face="Helvetica">APPOINTMENT STATUS</font></h1>
    <div class="Appointment_Form">

    <b>Appointment Date: </b><b class="Appointment_Time"><b class="Appointment_Date"><font color="red">{{ $appt->Appointment_Date }}</font></b>

      <br><br>
      <form name="frm">
        <!-- First Name Textbox-->
        <b>First Name: </b>
        <input type = "text"
        id = "First_Name"
        readonly
        style="width: 139px;" 
        value="{{ $appt->Client->First_Name }}"/>
        <br><br>
        <!--Last Name Textbox-->
        <b>Last Name: </b>
        <input type = "text"
        readonly
        id = "Last_Name" 
        value="{{ $appt->Client->Last_Name }}"/>
        <br><br>
        <!--Phone Number Textbox-->
        <b>Phone Number: </b>
        <input type = "text"
        id = "Phone_Number"
        readonly
        style="width: 110px;" 
        value="{{ $appt->client->Phone_Number }}"/>
        <br><br>

        <!--Senior Box Eligibility-->
        <b>Senior Box?</b>
        <br>
        <input type="text" id="SB_Eligibility" style="width: 100px" readonly />
        <br><br>

        <!--Appointment Status title and dropdown-->
        <b>Appointment Status</b>
        <select>
          <option value="Scheduled">Scheduled</option>
          <option value="Rescheduled">Rescheduled</option>
          <option value="Cancelled" id="cancelled">Cancelled</option>
          <option value="Complete">Complete</option>
        </select>
        <br><br>

        <!--buttons-->
        <input type="submit" value="Submit">
        <input type="button" value="Create New Appointment">
        <input type="submit" value="Cancel">
      </form>
    </div>
  </div>
</body>
</html>
