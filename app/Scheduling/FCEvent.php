<?php
//This object matches the format of a FullCalendar.io event object.
//This object can simply be json encoded and plugged into FC.io.

namespace App\Scheduling;

use App\Appointment;

class FCEvent {
    //This is the format expected by the FullCalendar event object start field.
    public static $FCStartFormat = "Y-m-d H:i:s";
    public static $FCDateFormat = "Y-m-d";
    public static $FCTimeFormat = "H:i:s";
    public static $FCTimeDisplayFormat = "h:ia";
    public static $pendingColor = "#3333ff";
    public static $defaultColor = "#808080";
    
    public $title;
    public $start;
    // public $color;

    public function __construct($appt) {
        $this->title = $appt->GetFullName()." - ".$appt->status->Status_Name;
        $this->start = $appt->GetDateTime()->format(FCEvent::$FCStartFormat);
        $this->id = $appt->Appointment_ID;

        switch($appt->status->Status_Name) {
            case "Pending": $this->color = FCEvent::$pendingColor; break;
            default: $this->color = FCEvent::$defaultColor; break;
        }
    }
}