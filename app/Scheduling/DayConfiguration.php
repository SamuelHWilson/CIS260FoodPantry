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

        $dc = DefaultConfig::find($this->liveDate->format('w'));
        
        $this->open = $dc->isOpen;
        $this->startTime = $this->open ? new DateTime($dc->openTime) : new DateTime("00:00:00");
        $this->FCMinTime = $this->startTime->format(FCEvent::$FCTimeFormat);
        $this->endTime = $this->open ? new DateTime($dc->closeTime) : new DateTime("00:00:00");
        $this->FCMaxTime = $this->endTime->format(FCEvent::$FCTimeFormat);
        $this->volunteerCount = $dc->numOfVol;
        $this->SBCutoffDay = 19;

        $this->appointments = null;
    }

    public function validateAppointment($appt, $isNew = true) {
        if ($this->open == false) {
            return 'closed';
        }

        $appointments = $this->getAppointments();
        $apptCount = $appointments->where('Appointment_Time', $appt->Appointment_Time)->count();
        //+1 because we are counting the new appointment being validated.
        if (($apptCount + ($isNew ? 1 : 0)) > $this->volunteerCount) {
            return 'slotFull';
        }

        $apptStartTime = new DateTime($appt->Appointment_Time);
        if ($apptStartTime < $this->startTime) {
            return 'beforeOpen';
        }

        $apptEndTime = new DateTime($appt->Appointment_Time);
        //+15 because the appointmnt can't start right at closing time.
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

    private function getAppointments() {
        if ($this->appointments != null) {
            return $this->appointments;
        } else {
            $this->appointments = Appointment::where('Appointment_Date', $this->date)->get();
            return $this->appointments;
        }
    }
}