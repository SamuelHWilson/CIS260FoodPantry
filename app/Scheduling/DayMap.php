<?php

namespace App\Scheduling;

use DateTime;
use DateInterval;
use App\Appointment;
use App\Client;
use App\Scheduling\FCEvent;
use App\Scheduling\DailyConfiguration;

class DayMap {
    var $dateToMap;

    var $volunteerCount;
    var $openningHours;
    var $closingHours;

    var $allAppointments;

    var $fifteenMinuteInterval;
    
    public function __construct($date = null) {
        if ($date === null) {
            $this->dateToMap = new DateTime();
        } else {
            $this->dateToMap = $date;
        }

        $this->fifteenMinuteInterval = new DateInterval('PT15M');
        $this->setConfigruation();
        $this->queryAppointments();
    }

    private function setConfigruation() {
        $this->volunteerCount = 4;
        $this->openningHours = new DateTime('08:00:00');
        $this->closingHours = new DateTime('14:00:00');
    }

    private function queryAppointments() {
        $this->allAppointments = Appointment::where('Appointment_Date', $this->dateToMap)->get();
    }

    public function getFCEventJSON() {
        $eventObjects = [];
        
        foreach ($this->allAppointments as $appointment) {
            $eventObjects[] = new FCEvent($appointment);
        }

        return json_encode($eventObjects, true);
    }


}