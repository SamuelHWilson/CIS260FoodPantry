<?php

namespace App\Http\Controllers\Pantry;

use DateTime;
use App\Http\Controllers\Controller;
use App\Scheduling\DayMap;
use App\Scheduling\FCEvent;

class AppointmentController extends Controller
{
    public function showDay($date) {
        $liveDate = new DateTime($date);
        $nextDate = date(FCEvent::$FCDateFormat, strtotime($date.' +1 day'));
        $prevDate = date(FCEvent::$FCDateFormat, strtotime($date.' -1 day'));

        $daymap = new DayMap($liveDate);
        $appointments = $daymap->getFCEventJSON();

        return view('appointment-calendar', ['view' => 'day', 
                                             'currentDate'=> $date, 
                                             'nextDate' => $nextDate, 
                                             'prevDate' => $prevDate,
                                             'appointments' => $appointments]);
    }
    
    public function showMonth($date) {
        //I perform the date math here in php because I have access to the modular FCEvent::$FCDateFormat property.
        $liveDate = new DateTime($date);
        $nextDate = date(FCEvent::$FCDateFormat, strtotime($date.' +1 month'));
        $prevDate = date(FCEvent::$FCDateFormat, strtotime($date.' -1 month'));

        return view('appointment-calendar', ['view' => 'month', 
                                             'currentDate'=> $date, 
                                             'nextDate' => $nextDate, 
                                             'prevDate' => $prevDate,
                                             'appointments' => '[]']);
    }
}