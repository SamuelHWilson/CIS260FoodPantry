<?php

namespace App\Scheduling;

use DateTime;
use DateInterval;
use App\Appointment;
use App\Client;
use App\Scheduling\FCEvent;
use App\Scheduling\TimeSlot;
use App\Scheduling\DailyConfiguration;

//This class will hold details on a Client, and optionally, a previous appointment for rescheduling and quick appointment making.
class PendingAppointment {
    public $client;
    public $quickName;
    public $appt;

    public function __construct($client, $appt = null) {
        $this->client = $client;
        $this->quickName = $client->First_Name." ".$client->Last_Name;
        $this->appt = $appt;
    }

    public function float() {
        session(['pendingAppointment' => $this]);
    }

    public function close() {
        session()->forget('pendingAppointment');
        session()->save();

        if ($this->appt != null) {
            $this->appt->Reschedule();
        }
    }

    public static function exists() {
        if (session('pendingAppointment', false)){
            return true;
        } else {
            return false;
        }
    }

    public static function get() {
        return session('pendingAppointment');
    }
}