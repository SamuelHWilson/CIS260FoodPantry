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

        return view('reporting.client-list-report')->with(['reportTitle' => 'FREQUENT NO-SHOWS', 'clients' => $clients]);
    }

    public function showRescheduleReport() {
        $clients = Client::whereHas('Flags', function($query){
            $query->where('Flag_DES', Flag::$RescheduleDesc);
        })->get();

        return view('reporting.client-list-report')->with(['reportTitle' => 'FREQUENT APPOINTMENT RESCHEDULERS', 'clients' => $clients]);
    }

    public function showDailyClientsReport($date) {
        $appointments = Appointment::whereDate('Appointment_Date', '=', $date)->with('client')->get();
        $clients = $appointments->pluck('client');
        $clients = $clients->sortBy('First_Name')->sortBy('Last_Name');

        return view('reporting.daily-clients-report')->with(['clients' => $clients, 'date' => $date]);
    }
    
    public function showDailyClientsSBReport($date) {
        $appointments = Appointment::whereDate('Appointment_Date', '=', $date)->with('client')->get();
        $clients = $appointments->pluck('client');
        $clients = $clients->sortBy('First_Name')->sortBy('Last_Name');

        $clients = $clients->reject(function($client) {
            return $client->SB_Eligibility == 0;
        });

        return view('reporting.daily-clients-report')->with(['clients' => $clients, 'date' => $date]);
    }

    public function showDailyAppointmentsReport($date) {
        $appointments = Appointment::whereDate('Appointment_Date', '=', $date)->with('client')->orderBy('Appointment_Time')->get();
        return view('reporting.daily-appointments-report')->with(['appointments' => $appointments, 'date' => $date]);
    }
}