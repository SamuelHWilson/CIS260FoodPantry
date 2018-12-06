<!doctype html>
<!--
PROJECT: Appointment MANAGER
PAGE: client.html
LAST UPDATE: 11/05/2018-->
<html lang="en">
<!--Beginning of body-->
<head>
  <title>Edit Client</title>
  <!--Link to CSS-->
  <link rel = "stylesheet" href = "{{ asset('css/styleMichael.css') }}">

  <!--Javascript for calendar-->
  <meta charset="utf-8">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript">
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
    return true;
  }
  </script>

</head>
<!--Beginning of body-->
<body class = "Index_body">
  <div class="Appointment_Body">
    <h1 class="Appointment_Header"><font face="Helvetica">EDIT CLIENT</font></h1>
<br>
<!--First Bubble-->
    <div class="client_edit_instructions">
      <b>Phone Number: </b>
      <input type = "text"
      id="Phone_Number"
      name="phone"
      placeholder="(xxx) xxx-xxxx"
      style="width: 110px;" />
      <br><br>
      <input type="submit" value="Search">
    </div>
    <br>
<!--Second Bubble-->
    <div class = "client_edit_instructions">
      <b>Please enter the client's phone number above and click search to bring up the client you would like to edit.</b>
    </div>
    <br>
    <div class="Appointment_Form">
      <form name="frm">
        <!-- First Name Textbox-->
        <b>First Name: </b>
        <input type = "text"
        id="First_Name"
        name="firstName"
        style="width: 139px;" />
        <br><br>
        <!--Last Name Textbox-->
        <b>Last Name: </b>
        <input type = "text"
        id = "Last_Name"
        name = "lastName" />
        <br><br>
        <!--Phone Number Textbox-->
        <b>Phone Number: </b>
        <input type = "text"
        id="Phone_Number"
        name="phone"
        placeholder="(xxx) xxx-xxxx"
        style="width: 110px;" />
        <br><br>
        <b>Senior Box?</b>
        <br>
        <!--Senior Box Radio buttons-->
        <input type="radio" name="SB_Eligibility" id="yes" value="Yes"> Yes<br>
        <input type="radio" name="SB_Eligibility" id="no" value="No"> No<br>
        <br><br>

        <!--buttons-->
        <input type="submit" value="Save Changes" onclick="return val();"/>
        <input type="submit" value="Cancel">
      </form>
    </div>
  </div>
</body>
</html>
