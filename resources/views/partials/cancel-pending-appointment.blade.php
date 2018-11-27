@if (PendingAppointment::exists())
    <form id='cancelPendingAppointment' method='POST' action='/appointments/cancel-pending'>
        @csrf
    </form>
    
    <div style = 'text-align : center; border-bottom: solid;'>
        <p style = 'font-size: 18px;' class='cancel-pending-appointment-text'>You are currently scheduling an appointment for {{ PendingAppointment::get()->quickName }}.</p>
        <button style = 'background-color: white; color: black; border: 2px solid #555555; font-size: 18px;' onclick="document.forms.namedItem('cancelPendingAppointment').submit()">Cancel</button> 
    </div>
@endif