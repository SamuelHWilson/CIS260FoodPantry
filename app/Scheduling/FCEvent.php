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
    public static $problemColor = "#e51616";
    
    public $title;
    public $start;
    public $id;
    public $color;

    private function __construct($title, $start, $id, $color, $problem = false) {
        $this->title = $title;
        $this->start = $start;
        $this->id = $id;
        $this->color = $color;
    }

    public static function createFromAppt($appt, $problem = false) {
        $title = $appt->GetFullName()." - ".($problem ? "Problem" : $appt->status->Status_Name);
        $start = $appt->GetDateTime()->format(FCEvent::$FCTimeFormat);

        if ($problem == false) {
            switch($appt->status->Status_Name) {
                case "Pending": $color = FCEvent::$pendingColor; break;
                default: $color = FCEvent::$defaultColor; break;
            }
        } else {
            $color = FCEvent::$problemColor;
        }

        return new FCEvent($title, $start, $appt->Appointment_ID, $color);
    }

    public static function createMarker($text, $start) {
        return new FCEvent($text, $start, 0, FCEvent::$defaultColor);
    }
}