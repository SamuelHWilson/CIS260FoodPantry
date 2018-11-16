<?php

namespace App\Http\Controllers\Pantry;

use DateTime;
use Illuminate\Http\Request;
use App\Appointment;
use App\Client;
use App\Http\Controllers\Controller;
use App\Scheduling\DayMap;
use App\Scheduling\FCEvent;
use App\Scheduling\PendingAppointment;

class AppointmentController extends Controller
{
    public function showCreateForm($date) {
        $dayMap = new DayMap(new DateTime($date));
        return view('crud.schedule-appointment')->with(['date' => $date, 'timeSlots' => $dayMap->getTimeSlots()]);
    }

    public function viewAppointment($id) {
        $appt = Appointment::with('Client')->where('Appointment_ID', $id)->first();
        return view('crud.view-appointment', ['appt' => $appt]);
    }

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

    public function checkIn(Request $request) {
        $appt = Appointment::findOrFail($request->id);
        $appt->CheckIn();
        return redirect('/appointments/check-in/schedule-next/'.$appt->Client_ID);
    }

    public function scheduleNext($id) {
        return view('crud.schedule-next')->with('client', Client::findOrFail($id));
    }

    public function createPendingAppointment(Request $request) {
        $client = Client::findOrFail($request->input('clientID'));
        if ($request->input('apptID', false)) {
            $appt = Appointment::findOrFail($request->input('apptID'));
        } else {
            $appt = null;
        }

        $penappt = new PendingAppointment($client, $appt);
        session(['pendingAppointment' => $penappt]);

        //Jumps forward from today's date because appointments will always be checked in today.
        $redirectDate = new DateTime();
        if ($request->input('jumpString', false)) {
            $redirectDate->modify($request->input('jumpString'));
        }

        return redirect('/appointments/day-view/'.$redirectDate->format(FCEvent::$FCDateFormat));
    }

    public function cancelPendingAppointment(Request $request) {
        session()->forget('pendingAppointment');
        session()->save();
        return redirect('/');
    }

    public function cancel(Request $request) {
        $appt = Appointment::findOrFail($request->id);
        $appt->Cancel();
        return redirect('/appointments/day-view/'.$appt->Appointment_Date);
    }

    public function createAppointment(Request $request) {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'firstName' => 'required|alpha',
            'lastName' => 'required|alpha',
            'phone' => 'required|regex:/^[0-9]{10}$/',
            'SB_Eligibility' => 'required|bool'
        ]);
    }
}