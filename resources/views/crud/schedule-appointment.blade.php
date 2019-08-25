<?php
  if (session('pendingAppointment', false)) {
    $hasPending = true;
    $pendingClient = session('pendingAppointment')->client;
    
    if(session('pendingAppointment')->appt != null) {
      $hasPendingAppt = true;
      $pendingAppt = session('pendingAppointment')->appt;
    } else {
      $hasPendingAppt = false;
    }
  } else {
    $hasPending = false;
  }
?>

<!doctype html>
<!--
PROJECT: Appointment MANAGER
PAGE: client.html
LAST UPDATE: 11/05/2018-->
<html lang="en">
<!--Beginning of body-->
<head>
  <title>Client Information</title>
  <!--Link to CSS-->
  <link rel = "stylesheet" href = "{{ asset('css/styleMichael.css') }}">

  <!--Javascript for calendar-->
  <meta charset="utf-8">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript">

//Form Validation
    //First Name
    if(frm.firstName.value==""){
      alert("You must enter a First Name for the client.")
      return false;
    }
    //Last Name
    if(frm.lastName.value==""){
      alert("You must enter a Last Name for the client.")
      return false;
    }
    //Phone Number
    if(frm.phone.value==""){
      alert("Please enter phone number.")
      return false;
    }
    if(isNaN(frm.phone.value)){
      alert("Please enter a valid phone number.")
      return false;
    }
    if((frm.phone.value).length < 10){
      alert("Phone number must be 10 digits.")
      return false;
    }
    if((frm.phone.value).length < 10){
      alert("Phone number must be 10 digits.")
    }
    //Radio Boxes
    var radio1 = document.getElementById('yes').checked;
    var radio2 = document.getElementById('no').checked;
    if((radio1=="")&&(radio2=="")){
      alert("Is the client eligable for a Senior Box?");
      return false;
    }

    return true;
  }

  </script>

</head>
<!--Beginning of body-->
<body class = "Index_body">
  @include('partials.navigation-bar')
  @include('partials.cancel-pending-appointment')
  <div class="Appointment_Body">
    <h1 class="Appointment_Header"><font face="Helvetica">CLIENT INFORMATION</font></h1>

    @if($hasPending)
      @if($pendingClient->Flags != null)
        @if($pendingClient->Flags->contains('Flag_DES', Flag::$NoShowDesc))
          <p>This client habitually misses appointments.</p>
        @endif

        @if($pendingClient->Flags->contains('Flag_DES', Flag::$RescheduleDesc))
          <p>This client habitually reschedules appointments.</p>
        @endif
      @endif
    @endif

    <div class="Appointment_Form">

      <form name="frm" method="POST" action='/appointments/create-appointment'>
        @csrf

        <!-- Used to make sure the back button returns to the calendar, not this page, when the form was submitted and sent back -->
        <input type='hidden' name='entryPoint' value="{{ old('entryPoint') ? old('entryPoint') : url()->previous() }}">

        <input type='hidden' id='overrideScheduleError' name='overrideScheduleError' value='0'>
        
        <b>Appointment Date: </b><input type="text" id="date" name="Appointment_Date" value="{{ $date }}" readonly/>
      <br><br>


      <!--Appointment time-->
      @if( $errors->first('hour') || $errors->first('minute') || $errors->first('ampm'))
          <p style='color:orangered;'>Select a valid time.</p>
      @endif

      <!--This is bad practice. It's on my todo list to fix.-->
      <!--These errors are produced after the appointment is checked against the schedule for the day.-->
      @if(session()->has('scheduleError'))
        @if(session('scheduleError') == 'closed')
            <p style='color:orangered;'><b>Least of These is closed this day. Please schedule this appointment for another day.</b></p>
        @endif

        @if(session('scheduleError') == 'beforeOpen')
            <p style='color:orangered;'><b>This time slot is scheduled before Least of These opens. Please pick another time slot.</b></p>
        @endif

        @if(session('scheduleError') == 'afterClose')
            <p style='color:orangered;'><b>This time slot is scheduled after Least of These closes. Please pick another time slot.</b></p>
        @endif

        @if(session('scheduleError') == 'slotFull')
            <p style='color:orangered;'><b>This time slot is already full of appointments. Please pick another time slot.</b></p>
        @endif

        @if(session('scheduleError') == 'lateSeniorBox')
            <p style='color:orangered;'><b>This client usually recives a senior box. Please schedule their appointment before the senior box cuttoff day.</b></p>
        @endif

        <script>
          function submitWithOverride() {
            document.getElementById('overrideScheduleError').value = 1;
            document.forms[0].submit();
          }
        </script>
        <button onclick='submitWithOverride()'>Schedule Appointment Anyway</button><br><br>
      @endif

      <b>Appointment Time: </b>
      <select name='hour'>
        @if( old('hour'))
          <!-- Cleaner then checking each option to determine which should be selected. -->
          <option value="{{old('hour')}}" hidden selected>{{old('hour')}}</option>
        @else
          <!-- Invalidates time field by default. Ensures volunteers manually set field. -->
          <option value="" selected disabled hidden>0</option>
        @endif
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
      <select name='minute' value="">
        @if( old('minute'))
          <option value="{{old('minute')}}" hidden selected>{{old('minute')}}</option>
        @endif

        <option value="00">00</option>
        <option value="15">15</option>
        <option value="30">30</option>
        <option value="45">45</option>
      </select>
      <select name='ampm' value="">
        @if( old('ampm'))
          <option value="{{old('ampm')}}" hidden selected>{{old('ampm')}}</option>
        @endif

        <option value="am">am</option>
        <option value="pm">pm</option>
      </select>
      <br><br>

        <!-- First Name Textbox-->
        @if( $errors->first('First_Name'))
          <p style='color:orangered;'><font face="Helvetica"><b>First name can only include letters. Example: Matthew</font></b></p>
        @endif
        <b>First Name: </b>
        <input type = "text"
        id="First_Name"
        name="First_Name"
        placeholder = "John"
        style="width: 139px;"

        @if($hasPending)
          value="{{ $pendingClient->First_Name }}"
          readonly
        @else
          value="{{ old('First_Name') }}"
        @endif
        />

        <br><br>
        <!--Last Name Textbox-->
        @if( $errors->first('Last_Name'))
          <p style='color:orangered;'><font face="Helvetica"><b>Last name can only include letters. Example: Smith</font></b></p>
        @endif
        <b>Last Name: </b>
        <input type = "text"
        id = "Last_Name"
        name = "Last_Name"
        placeholder = "Smith"
        
        @if($hasPending)
          value="{{ $pendingClient->Last_Name }}"
          readonly
        @else
          value="{{ old('Last_Name') }}"
        @endif 
        
        />
        <br><br>
        <!--Phone Number Textbox-->
        @if( $errors->first('Phone_Number'))
          <p style='color:orangered;'><font face="Helvetica"><b>Phone number must be standard 10 digit phone number. Can include only numbers. Do not include formating. Example: 4178654545</font></b></p>
        @endif
        <b>Phone Number: </b>
        <input type = "text"
        id="Phone_Number"
        name="Phone_Number"
        placeholder="(xxx) xxx-xxxx"
        style="width: 110px;"

        @if($hasPending)
          value="{{ $pendingClient->Phone_Number }}"
          readonly
        @else
          value="{{ old('Phone_Number') }}"
        @endif 
        
        />

        <br><br>
        <!--Notes Textbox-->
        @if( $errors->first('Appointment_Note'))
          <p style='color:orangered;'><font face="Helvetica"><b>Notes can only include standard letters, numbers, and punctuation.</font></b></p>
        @endif
        <b>Notes: </b><br>
        <textarea
        id="Appointment_Note"
        name="Appointment_Note"
        placeholder="Add anything noteworthy about the appointment here."
        style="width: 80%;"
        rows="3">{{ old('Appointment_Note') ? old('Appointment_Note') : ($hasPendingAppt ? $pendingAppt->Appointment_Note : "") }}</textarea>

        <br><br>
        <!--Senior Box Radio buttons-->
        <b>Senior Box?</b>
        <br>
        <?php
          $sbTrue = (old('SB_Eligibility') == true) || ($hasPending == true && $pendingClient->SB_Eligibility == true);
        ?>

        <input type="radio" name="SB_Eligibility" id="yes" value="1" @if($sbTrue) checked @endif> Yes<br>
        <input type="radio" name="SB_Eligibility" id="no" value="0" @if(!$sbTrue) checked @endif> No<br>
        <br><br>

        <!--buttons-->
        <input type="submit" value="Submit" onclick="return val();"/>
      </form>

      <input type="submit" value="Reset">
      <input type="submit" value="Cancel">
      <button onclick="window.location = '{{ old('entryPoint') ? old('entryPoint') : url()->previous() }}'">Go Back</button>
    </div>
  </div>
</body>
</html>
