@if (session()->has('pendingAppointment'))
    <form id='cancelPending' method='POST' action='/appointments/cancel-pending'>
        @csrf
    </form>
    
    <div>
        <p class='cancel-pending-appointment-text'>You are currently scheduling an appointment for {{ session('pendingAppointment')->quickName }}.</p>
        <button onclick="document.forms.namedItem('cancelPending').submit()">Cancel</button> 
    </div>
@endif