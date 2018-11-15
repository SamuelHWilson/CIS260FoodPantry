<?php

namespace App\Scheduling;

use DateTime;
use DateInterval;
use App\Scheduling\FCEvent;
use App\Scheduling\DailyConfiguration;

class TimeSlot {
    public $time;
    public $full;
    public $optionString;

    public function __construct($time, $full) {
        $this->$time = $time;
        $this->full = $full;
        $isDisabled = ( $full ? 'disabled' : '' );
        $this->optionString = '<option '.$isDisabled.' value="'.$time.'">'.$time.'</option>';
    }
}