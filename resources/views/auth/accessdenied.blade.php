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
  <form method="POST" action="{{ route('logout') }}" id='logout'>
      @csrf
  </form>

  <div class="Appointment_Body">
    <h1 class="Appointment_Header"><font face="Helvetica">ACCESS DENIED</font></h1>
    <div class="Appointment_Form">

      <p><b>You don't have permission to do that.</b></p>
      <p>In order to make the changes you want, log in under another account with more permissions.</p>
      <p>If you have accidentally reached this page, please select "Cancel" below.</p><br>
      <button onclick='document.forms.namedItem("logout").submit()'>Logout</button>
      <button onclick='window.location = "{{ url()->previous() }}"'>Cancel</button>
    </div>
  </div>
</body>
</html>
