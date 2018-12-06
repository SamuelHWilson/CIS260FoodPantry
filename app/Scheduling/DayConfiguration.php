<?php

namespace App\Scheduling;

use DateTime;
use DateInterval;
use App\Appointment;
use App\Client;
use App\DefaultConfig;
use App\Scheduling\FCEvent;
use App\Scheduling\TimeSlot;
use App\Scheduling\DailyConfiguration;

class DayConfiguration {
    public $date;
    public $liveDate;
    public $open;
    public $startTime;
    public $FCMinTime;
    public $endTime;
    public $FCMaxTime;
    public $volunteerCount;
    public $seniorBoxCutoffDay;

    public function __construct($date) {
        $this->date = $date;
        $this->liveDate = new DateTime($date);

        $dc = DefaultConfig::findOrFail($this->liveDate->format('w'));

        $this->open = $dc->isOpen;
        $this->startTime = new DateTime($dc->openTime);
        $this->FCMinTime = $this->startTime->format(FCEvent::$FCTimeFormat);
        $this->endTime = new DateTime($dc->closeTime);
        $this->FCMaxTime = $this->endTime->format(FCEvent::$FCTimeFormat);
        $this->volunteerCount = $dc->numOfVol;
        $this->SBCutoffDay = 19;
    }

    public function validateAppointment($appt) {
        if ($this->open == false) {
            return 'closed';
        }

        $apptCount = Appointment::where(['Appointment_Date' => $this->date, 'Appointment_Time' => $appt->Appointment_Time])->count();
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

        if ($appt->Client->SB_Eligibility == true) {
           $apptDate = new DateTime($appt->Appointment_Date);
           $apptDay = $apptDate->format('d');

           if ($apptDay > $this->SBCutoffDay) {
               return 'lateSeniorBox';
           }
        }

        return 'validated';
    }
}