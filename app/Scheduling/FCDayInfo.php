<?php
//This object matches the format of a FullCalendar.io event object.
//This object can simply be json encoded and plugged into FC.io.

namespace App\Scheduling;

use DateTime;
use App\Scheduling\FCEvent;

class FCDayInfo {
    //This is a janky workaround for showing summary info on the month view.
    //These are FC event objects with custom titles.
    
    public $title;
    public $start;
    public $date;

    public function __construct($date, $apptNumber) {
        $this->date = $date;
        
        $this->title = $apptNumber.' Appointments';
        $liveDate = new DateTime($date);
        $this->start = $liveDate->format(FCEvent::$FCDateFormat);
    }
    
}