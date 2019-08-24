<!doctype html>
<html lang="en">
<head>
    <title>Change Password</title>
    <link rel = "stylesheet" href = "{{ asset('css/styleMichael.css') }}">

    <!--Javascript for calendar-->
    <meta charset="utf-8">
</head>
<body class = "Index_body">
    @include('partials.navigation-bar')
    <div class="Appointment_Body">
        <h1 class="Appointment_Header"><font face="Helvetica">Change Password</font></h1>
        @if(!session('status'))<p style='text-align:center;'>Fill out the form bellow to change your password.</p>
        
        <div class="Appointment_Form">
            <form method="POST" action="">
                @csrf

                <p>Choose an access level.</p>
                <input type="radio" name="name" id="admin" value="admin" @if(old('name') == 'admin') checked @endif> Manage Business<br>
                <input type="radio" name="name" id="read_write" value="edit" @if(old('name') == 'edit') checked @endif> View and Modify Appointments<br>
                <input type="radio" name="name" id="ready_only" value="view" @if(old('name') == 'view') checked @endif> View Appointments Only<br>

                <p>Enter your current password.</p>
                @foreach($errors->get('oldPassword') as $message)
                    <p class='val-error'>{{$message}}</p>
                @endforeach
                <b>Old Password: </b>
                <input  type = "password"
                        name="oldPassword"
                        placeholder="Old Password"/>
                <br><br>

                <p>Create a new password.</p>
                @foreach($errors->get('newPassword') as $message)
                    <p class='val-error'>{{$message}}</p>
                @endforeach
                <b>New Password: </b>
                <input  type = "password"
                        name="newPassword"
                        placeholder="New Password"/>
                <br><br>

                <p>Type the new password again.</p>
                @foreach($errors->get('newRetype') as $message)
                    <p class='val-error'>{{$message}}</p>
                @endforeach
                <b>New Password: </b>
                <input  type = "password"
                        name="newRetype"
                        placeholder="New Password"/>
                <br><br>

                <input type="submit" value="Done"/>
            </form>

            @else<p style='text-align:center;color:darkgreen;font-weight:bold;'>Your password was changed successfully</p>
            <button onclick='window.location = "/"'>Go Back</button>@endif
        </div>
    </div>
</body>
