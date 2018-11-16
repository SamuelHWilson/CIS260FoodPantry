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
    public $appointment;

    public function __construct($client, $appointment = null) {
        $this->client = $client;
        $this->quickName = $client->First_Name." ".$client->Last_Name;
        $this->appointment = $appointment;
    }
}