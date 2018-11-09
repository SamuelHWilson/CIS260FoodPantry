<?php
//This object matches the format of a FullCalendar.io event object.
//This object can simply be json encoded and plugged into FC.io.

use App\Appointment;

class FCEvent {
    //This is the format expected by the FullCalendar event object start field.
    public static $FCStartFormat = "Y-m-d H:i:s";
    
    public $title;
    public $start;

    public function __construct($appt) {
        $title = $appt->GetFullName()." - ".$appt->status->Status_Name;
        $start = $appt->GetDateTime()->format($FCStartFormat);
    }
}