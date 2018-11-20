@if (session()->has('pendingAppointment'))
    <form id='cancelPending' method='POST' action='/appointments/cancel-pending'>
        @csrf
    </form>
    
    <div style = 'text-align : center; border-bottom: solid;'>
        <p style = 'font-size: 18px;' class='cancel-pending-appointment-text'>You are currently scheduling an appointment for {{ session('pendingAppointment')->quickName }}.</p>
        <button style = 'background-color: white; color: black; border: 2px solid #555555; font-size: 18px;' onclick="document.forms.namedItem('cancelPending').submit()">Cancel</button> 
    </div>
@endif