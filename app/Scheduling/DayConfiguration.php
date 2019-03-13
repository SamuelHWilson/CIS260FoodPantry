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

use App\AvailabilityDay;

class DayConfiguration {
    public static $seniorBoxCutoffDay = 19;

    public $liveDate;
    public $aDay;
    private $appointments = null;

    public function __construct($date) {
        $this->liveDate = new DateTime($date);
        $this->aDay = AvailabilityDay::findByDate($date);
    }

    public function validateAppointment($appt, $isNew = true) {
        if ($this->aDay->is_open == false) {
            return 'closed';
        }

        $appointments = $this->getAppointments();
        $apptCount = $appointments->where('Appointment_Time', $appt->Appointment_Time)->count();
        //+1 because we are counting the new appointment being validated.
        if (($apptCount + ($isNew ? 1 : 0)) > $this->aDay->available_staff) {
            return 'slotFull';
        }

        if ($appt->Appointment_Time < $this->aDay->getFCOpenTime()) {
            return 'beforeOpen';
        }

        if ($appt->getEndTime() > $this->aDay->getFCCloseTime()) {
            return 'afterClose';
        }

        if ($appt->Client->SB_Eligibility == true) {
           $apptDate = new DateTime($appt->Appointment_Date);
           $apptDay = $apptDate->format('d');

           if ($apptDay > DayConfiguration::$seniorBoxCutoffDay) {
               return 'lateSeniorBox';
           }
        }

        return 'validated';
    }

    private function getAppointments() {
        if ($this->appointments != null) {
            return $this->appointments;
        } else {
            $this->appointments = Appointment::where('Appointment_Date', $this->liveDate->format('Y-m-d'))->get();
            return $this->appointments;
        }
    }
}