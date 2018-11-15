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
//Dropdown Calendar
  $( function() {
    $( "#datepicker" ).datepicker();
  } );

//Form Validation
  function  val(){
    //Calendar
    if(frm.date.value==""){
      alert("You must select a date for the appointment.")
      return false;
    }
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
  <div class="Appointment_Body">
    <h1 class="Appointment_Header"><font face="Helvetica">CLIENT INFORMATION</font></h1>
    <div class="Appointment_Form">

      <form name="frm" method="POST" action='/appointments/create-appointment'>
        @csrf
      <b>Appointment Date: </b><input type="text" id="datepicker" name="date" value="{{ $date }}"/>
      <br><br>

      <!--Appointment time-->
      <b>Appointment Time: </b>
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
        <option value="15">15</option>
        <option value="30">30</option>
        <option value="45">45</option>
      </select>
      <select>
        <option value="AM">AM</option>
        <option value="PM">PM</option>
      </select>
      <br><br>

        <!-- First Name Textbox-->
        @if( $errors->first('firstName'))
          <p style='color:orangered;'>First name can only include letters. Example: Matthew</p>
        @endif
        <b>First Name: </b>
        <input type = "text"
        id="First_Name"
        name="firstName"
        style="width: 139px;"
        value="{{ old('firstName') }}" />
        <br><br>
        <!--Last Name Textbox-->
        @if( $errors->first('lastName'))
          <p style='color:orangered;'>Last name can only include letters. Example: Smith</p>
        @endif
        <b>Last Name: </b>
        <input type = "text"
        id = "Last_Name"
        name = "lastName"
        value = {{ old('lastName') }} />
        <br><br>
        <!--Phone Number Textbox-->
        @if( $errors->first('phone'))
          <p style='color:orangered;'>Phone number must be standard 10 digit phone number. Can include only numbers. Do not include formating. Example: 4178654545</p>
        @endif
        <b>Phone Number: </b>
        <input type = "text"
        id="Phone_Number"
        name="phone"
        placeholder="(xxx) xxx-xxxx"
        style="width: 110px;"
        value = {{ old('phone') }} />
        <br><br>
        <b>Senior Box?</b>
        <br>
        <!--Senior Box Radio buttons-->
        <input type="radio" name="SB_Eligibility" id="yes" value="1" @if( old('SB_Eligibility') == true ) checked @endif> Yes<br>
        <input type="radio" name="SB_Eligibility" id="no" value="0" @if( old('SB_Eligibility') == false ) checked @endif> No<br>
        <br><br>

        <!--buttons-->
        <input type="submit" value="Submit" onclick="return val();"/>
        <input type="submit" value="Reset">
        <input type="submit" value="Cancel">
      </form>
    </div>
  </div>
</body>
</html>
