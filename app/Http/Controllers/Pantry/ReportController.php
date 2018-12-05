<?php

namespace App\Http\Controllers\Pantry;

use DateTime;
use App\Client;
use App\Flag;
use App\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function showReports() {
        return view('reporting.reports');
    }

    public function showNoShowReport() {
        $clients = Client::whereHas('Flags', function($query){
            $query->where('Flag_DES', Flag::$NoShowDesc);
        })->get();

        return view('reporting.no-show-report')->with('clients', $clients);
    }

    public function showDailyReport($date) {
        $appointments = Appointment::whereDate('Appointment_Date', '=', $date)->with('client')->get();
        // dd($appointments[0]->Client);
        // dd($appointments);

        return view('reporting.daily-schedule-report')->with(['appointments' => $appointments, 'date' => $date]);
    }
}