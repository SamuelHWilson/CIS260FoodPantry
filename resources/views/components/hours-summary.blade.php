<?php
//Pass this component an availability named $a
$aDays = $a->availability_days;
?>
<table style="width:100%;table-layout:fixed;">
    <tr>
        <th></th>
        <th>Sun</th>
        <th>Mon</th>
        <th>Tue</th>
        <th>Wed</th>
        <th>Thu</th>
        <th>Fri</th>
        <th>Sat</th>
    </tr>
    <tr>
        <th>Open At</th>
        @foreach($aDays as $aDay)
            @if ($aDay->is_open) <td>{{$aDay->getDisplayOpenTime()}}</td> 
            @else <td rowspan="3">Closed</td> @endif
        @endforeach
    </tr>
    <tr>
        <th>Close At</th>
            @foreach($aDays as $aDay)
            @if ($aDay->is_open) <td>{{$aDay->getDisplayCloseTime()}}</td> @endif
        @endforeach
    </tr>
    <tr>
        <th>Staff</th>
            @foreach($aDays as $aDay)
            @if ($aDay->is_open) <td>{{$aDay->available_staff}}</td> @endif
        @endforeach
    </tr>
</table>
    