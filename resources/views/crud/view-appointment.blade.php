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
  <form id='restore' method='POST' action='/appointments/restore'>
    @csrf
    <input type='hidden' name='id' value='{{ $appt->Appointment_ID }}'>
  </form>
  <form id='reschedule' method='POST' action='/appointments/create-pending'>
    @csrf
    <input type='hidden' name='clientID' value="{{ $appt->client->Client_ID }}">
    <input type='hidden' name='apptID' value="{{ $appt->Appointment_ID }}">
  </form>

  <div class="Appointment_Body">
    <h1 class="Appointment_Header"><font face="Helvetica">APPOINTMENT INFORMATION</font></h1>

    @if($appt->Client->Flags != null)
      @if($appt->Client->Flags->contains('Flag_DES', Flag::$NoShowDesc))
        <p>This client habitually misses appointments.</p>
      @endif

      @if($appt->Client->Flags->contains('Flag_DES', Flag::$RescheduleDesc))
        <p>This client habitually reschedules appointments.</p>
      @endif
    @endif

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
        value="{{ $appt->Client->Phone_Number }}"/>
        <br><br>

        <!--Notes Textbox-->
        <b>Phone Number: </b><br>
        <textarea
        id = "Phone_Number"
        disabled
        style="width: 80%;">{{ $appt->Appointment_Note }}</textarea>
        <br><br>

        <b>Senior Box?</b>
        <br>
        <!--Senior Box Radio buttons-->
        <input type="radio" name="SB_Eligibility" id="yes" value="1" disabled @if($appt->Client->SB_Eligibility == true) checked @endif> Yes<br>
        <input type="radio" name="SB_Eligibility" id="no" value="0" disabled @if($appt->Client->SB_Eligibility == false) checked @endif> No<br>
        <br><br>
      </form>

      <button onclick="document.forms.namedItem('checkIn').submit()">Check-In</button>
      <button onclick="document.forms.namedItem('reschedule').submit()">Reschedule</button>
      @if(!$appt->isCancelled()) <button onclick="document.forms.namedItem('cancel').submit()">Cancel</button>
      @else <button onclick="document.forms.namedItem('restore').submit()">Restore</button> @endif
      <button onclick="window.location = '{{ url()->previous() }}'">Go Back</button>
    </div>
  </div>
</body>
</html>
