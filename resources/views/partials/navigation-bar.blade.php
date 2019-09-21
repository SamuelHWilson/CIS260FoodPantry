<form method="POST" action="{{ route('logout') }}" id='logout'>
    @csrf
</form>

<ul class="navList">
    <?php 
        $user = auth()->user();
        $canEdit = ($user->name == 'edit' || $user->name == 'admin') ? true : false;
        $isAdmin = ($user->name == 'admin') ? true : false;
    ?>
    <li class="navItem"><a class="navBar" href="/">Calendar</a></li>

    @if ($canEdit)
        <li class="navItem"><a class="navBar" href="/clients/search">Clients</a></li>
    @endif

    @if ($isAdmin)
        <li class="navItem"><a class="navBar" href="/reporting/reports">Reports</a></li>
        <li class="navItem"><a class="navBar" href="/hours/view-hours">Hours and Availability</a></li>
        <li class="navItem"><a class="navBar" href="/password/change">Change Passwords</a></li>
        <li class="navItem"><a class="navBar" href="/appointments/create-bulk">Create Bulk Appointments</a></li>
    @endif

    <li class="navItem" style="float:right" onclick='document.forms.namedItem("logout").submit()'><a class="navBar">Lock Page</a></li>
</ul>