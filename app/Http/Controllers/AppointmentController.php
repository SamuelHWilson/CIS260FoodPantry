<?php

namespace App\Http\Controllers;

use DateTime;
use App\Scheduling\DayMap;

class AppointmentController extends Controller
{
    
    public function test()
    {
        $temp = new DayMap(new DateTime('2018-11-05'));
        return $temp->getFCEventJSON();
    }
}