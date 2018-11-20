<?php

namespace App\Scheduling;

use DateTime;
use DateInterval;
use App\Appointment;
use App\Client;
use App\Scheduling\FCEvent;
use App\Scheduling\TimeSlot;
use App\Scheduling\DailyConfiguration;

class DayConfiguration {
    public $open;
    public $startTime;
    public $FCMinTime;
    public $endTime;
    public $FCMaxTime;
    public $volunteerCount;

    public function __construct($date) {
        $this->open = true;
        $this->startTime = new DateTime('8:00am');
        $this->FCMinTime = $this->startTime->format(FCEvent::$FCTimeFormat);
        $this->endTime = new DateTime('3:00pm');
        $this->FCMaxTime = $this->endTime->format(FCEvent::$FCTimeFormat);
        $this->volunteerCount = 4;
    }

    public function validateAppointment($appt) {
        if ($this->open == false) {
            return 'closed';
        }

        $apptCount = Appointment::where('Appointment_Time', $appt->Appointment_Time)->count();
        if (($apptCount + 1) > $this->volunteerCount) {
            return 'slotFull';
        }

        $apptStartTime = new DateTime($appt->Appointment_Time);
        if ($apptStartTime < $this->startTime) {
            return 'beforeOpen';
        }

        $apptEndTime = new DateTime($appt->Appointment_Time);
        $apptEndTime->modify('+15 minutes');
        if ($apptEndTime > $this->endTime) {
            return 'afterClose';
        }

        return 'validated';
    }
}