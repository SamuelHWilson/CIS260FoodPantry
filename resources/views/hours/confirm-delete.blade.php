<!doctype html>
<html lang="en">
<head>
    <title>Delete Hours Change</title>
    <link rel = "stylesheet" href = "{{ asset('css/styleMichael.css') }}">

    <!--Javascript for calendar-->
    <meta charset="utf-8">
</head>
<body class = "Index_body">
    <div class="Appointment_Body clearfix" style="width:45%;">
        <h1 class="Appointment_Header"><font face="Helvetica">Confirm Delete</font></h1>
        <p style='text-align:center;'>Are you sure you want to delete the hours change, taking place on <b>{{$aDate->effective_date}}</b>?</p>
        @component('components.hours-summary',['a' => $aDate->availability])@endcomponent
        <div style="float:left;margin-top:1.5em;">
            <button style='margin:auto;' onclick="window.location='{{ url()->previous() }}'">No, go back.</button>
        </div>
        <div style="float:right;margin-top:1.5em;">
            <form method='POST' action='../delete-change'>
                @csrf
                <input type='hidden' name='id' value="{{$aDate->id}}">
            </form>
            <button onclick='document.forms[0].submit()'>Yes, delete it.</button>
        </div>
    </div>
</body>
