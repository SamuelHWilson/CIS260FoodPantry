<form method="POST" action="{{ route('logout') }}" id='logout'>
    @csrf
</form>

<ul class="navList">
    <li class="navItem"><a class="navBar" href="/">Calendar</a></li>
    <li class="navItem"><a class="navBar" href="/reporting/reports">Reports</a></li>
    <li class="navItem"><a class="navBar" href="/hours/view-hours">Hours and Availability</a></li>
    <li class="navItem"><a class="navBar" href="/password/change">Change Password</a></li>
    <li class="navItem" style="float:right" onclick='document.forms.namedItem("logout").submit()'><a class="navBar">Lock Page</a></li>
</ul>