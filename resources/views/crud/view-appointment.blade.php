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
  <link rel = "stylesheet" href = "{{ asset('css/style.css') }}">

</head>
<!--Beginning of body-->
<body class='Index_body'>
    @include('partials.navigation-bar')
  <div class='Index_mainDiv' style='width: 35%; margin-left: auto; margin-right: auto; position: relative;'>  
    <div class='Index_container'>
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

      <script>
        function EditNotes() {
          document.getElementById('notes').style.display = 'none';
          document.getElementById('edit-notes').style.display = 'block';
        }
      </script>

      <div class="Appointment_Body">
        <div class='header-box'>
          <h1>Appointment Information</h1>
        </div>

        @if($valError != null)
          <div class='fluffy-summary problem' style='margin: 25px 0px;'><p>There is a problem with this appointment: <br>{{$valError}}</p></div>
        @endif

        <p class='size-1'>{{$appt->Appointment_Date}} @ {{$appt->EasyTime()}}</p>
        <p class='size-2' style='margin-top: 20px;'>{{$appt->Client->First_Name}} {{$appt->Client->Last_Name}}</p>
        <p class='size-1'>{{$appt->Client->PrettyPhone()}}</p>

        <div style='width: 100%; text-align: left; margin: 40px 0px;' class='clearfix'>
          <div style='width: 25%; border-right: 2px solid black; float: left;'>
            <p>Senior Box?</p>
            <input type="radio" name="SB_Eligibility" id="yes" value="1" disabled @if($appt->Client->SB_Eligibility == true) checked @endif> Yes<br>
            <input type="radio" name="SB_Eligibility" id="no" value="0" disabled @if($appt->Client->SB_Eligibility == false) checked @endif> No<br>
          </div>
          <div style='width: 70%; float: right;'>
            <?php
              $addString = ""; 
              if ($appt->Client->Flags != null) {
                if ($appt->Client->Flags->contains('Flag_DES', Flag::$NoShowDesc)) {
                  $addString .= "This client often misses appointments. ";
                }
                if ($appt->Client->Flags->contains('Flag_DES', Flag::$RescheduleDesc)) {
                  $addString .= "This client often reschedules appointments. ";
                }
              }
            ?>
            <div id='notes'>
              <p><span class='shy'>Notes: </span>{{$appt->Appointment_Note}} <span class='error'>{{$addString}}</span></p>
              <button class='fluffy-button shy' style='float: right;' onclick='EditNotes()'>Update Notes</button>
            </div>
            <div id='edit-notes' style='display: none;'>
              <form action='{{route("editNote")}}' method='POST'>
                @csrf
                <input type='hidden' name='Appointment_ID' value={{$appt->Appointment_ID}}>
                @if (!$errors->isEmpty())<p class='error tac'>Notes can only include standard letters, numbers, and punctuation.</p> @endif
                <textarea rows='4' name='Appointment_Note' class='fluffy-input' style='width: 100%;'>{{old('Appointment_Note') ? old('Appointment_Note') : $appt->Appointment_Note}}</textarea>
                <input style='float: right;' class='fluffy-button shy confirm' type='submit' value='Save Notes'>
                @if (!$errors->isEmpty()) <script>EditNotes()</script> @endif
              </form>
            </div>
          </div>
        </div>
        <div style='display: inline-block;'>
          <p class='size-1 underline'>Actions</p>
          <button class='fluffy-button' onclick="document.forms.namedItem('checkIn').submit()">Check-In</button>
          <button class='fluffy-button'  onclick="document.forms.namedItem('reschedule').submit()">Reschedule</button>
          @if(!$appt->isCancelled()) <button class='fluffy-button'  onclick="document.forms.namedItem('cancel').submit()">Cancel</button>
          @else <button class='fluffy-button'  onclick="document.forms.namedItem('restore').submit()">Restore</button> @endif
        </div>
      </div>
      <button class='fluffy-button shy' style='position: absolute; bottom: 5px; left: 5px;' onclick="window.location = '{{ url()->previous() }}'">Go Back</button>
    </div>
  </div>
</body>
</html>
