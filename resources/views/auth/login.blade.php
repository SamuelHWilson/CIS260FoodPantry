<!doctype html>
<!--
PROJECT: Appointment MANAGER
PAGE: Index.html
LAST UPDATE: 11/05/2018-->
<html>
<!--Beginning of header-->
<head>
  <title>Login</title>
  <link rel = "stylesheet" href = "{{ asset('css/styleMichael.css') }}">
</head>
<!--Beginning of body-->
<body class = "Index_body">
  <div class = "Index_mainDiv">
    <div class = "Index_container">

      <!--Div for Title and Image-->
      <div class = "header">
        <h1><font face="Helvetica">APPOINTMENT MANAGER</font></h1>
        <br>
        <img class = "Index_image" src ="http://chambermaster.blob.core.windows.net/images/customers/761/members/88/logos/MEMBER_PAGE_HEADER/LOT_Logo.jpg">
      </div>

      <!--Input Elements-->
      <div class="Index_login">
<<<<<<< HEAD
        <label for="uname"><b>Account: </b></label><br>
        <input type="radio" name="username" id="read_write" value="read/write"> Read/Write<br>
        <input type="radio" name="username" id="ready_only" value="read_only"> Read Only<br>
        <br><br>
        <label for="psw"><b>Password: </b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>
        <br><br>
        <!--Submit Button-->
        <button type="submit">Login</button>
=======
        <form method="POST" action="/login">
          @csrf
          <label for="name"><b>Username: </b></label>
          <input type="text" placeholder="Enter Username" name="name" required>
          <br><br>
          <label for="password"><b>Password: </b></label>
          <input type="password" placeholder="Enter Password" name="password" required>
          <br><br>
          <!--Submit Button-->
          <input type="submit" value='Login'>
        </form>
>>>>>>> master
      </div>
    </div>
  </div>

</body>
</html>
