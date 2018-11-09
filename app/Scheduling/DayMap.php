<?php

namespace App\Scheduling;

use DateTime;
use DateInterval;
use App\Appointment;
use App\Client;
use App\Scheduling\DailyConfiguration;

class DayMap {
    var $dateToMap;

    var $volunteerCount;
    var $openningHours;
    var $closingHours;

    //Appointments can be sorted in to these slots and randomly accessed via appointment time.
    var $appointmentSlots;

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
        $this->generateEmptySlots();
        $this->queryAppointments();
        $this->sortAppointments();
        dd($this->appointmentSlots);
    }

    private function setConfigruation() {
        $this->volunteerCount = 4;
        $this->openningHours = new DateTime('08:00:00');
        $this->closingHours = new DateTime('14:00:00');
    }
    
    private function generateEmptySlots() {
        $this->appointmentSlots = array();
        $slotTime = new DateTime('00:00:00');

        for ($i = 0; $i <= 96; $i++) {
            $this->appointmentSlots[$slotTime->format(Appointment::$timeDisplayFormat)] = array();
            $slotTime->add($this->fifteenMinuteInterval);
        }
    }

    private function queryAppointments() {
        $this->allAppointments = Appointment::where('Appointment_Date', $this->dateToMap)->get();
    }

    private function sortAppointments() {
        foreach ($this->allAppointments as $appointment) {
            $this->appointmentSlots[$appointment->GetDisplayTime()][] = $appointment;
        }
    }
}