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
use App\Scheduling\DayConfiguration;

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

        $dayConfig = new DayConfiguration($liveDate);

        return view('appointment-calendar', ['view' => 'day', 
                                             'currentDate'=> $date, 
                                             'nextDate' => $nextDate, 
                                             'prevDate' => $prevDate,
                                             'appointments' => $appointments,
                                             'dayConfig' => $dayConfig]);
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
        $this->clearPendingAppointment();
        return redirect('/');
    }

    public function cancel(Request $request) {
        $appt = Appointment::findOrFail($request->id);
        $appt->Cancel();
        return redirect('/appointments/day-view/'.$appt->Appointment_Date);
    }

    public function createAppointment(Request $request) {
        $validatedData = $request->validate([
            'Appointment_Date' => 'required|date',
            'First_Name' => 'required|alpha',
            'Last_Name' => 'required|alpha',
            'Phone_Number' => 'required|regex:/^[0-9]{10}$/',
            'SB_Eligibility' => 'required|bool',

            'hour' => 'required|between:1,12',
            'minute' => 'required|in:00,15,30,45',
            'ampm' => 'required|in:am,pm'
        ]);

        $fullTime = new DateTime($request->hour.":".$request->minute.$request->ampm);
        $FCTime = $fullTime->format(FCEvent::$FCTimeDisplayFormat);
        
        $appt = new Appointment();
        $appt->Status_ID = Appointment::$PendingStatus;
        $appt->Appointment_Date = $request->Appointment_Date;
        $appt->Appointment_Time = $FCTime;
        $appt->Appointment_Note = "";

        //It's weird that we still get client input even if we have the ID, but having all the client
        //fields always visible makes it easier for the volunteers to use the software.

        //It would be a pain to render the information, but only submit it when we don't have a Client_ID,
        //so we just ignore the input when we do.
        if (session('pendingAppointment', false)) {
            $client = session('pendingAppointment')->client;
        } else {
            // dd($request->First_Name);
            $client = Client::firstOrCreate(
                ['Phone_Number' => $request->Phone_Number,
                 'Last_Name' => $request->Last_Name,
                 'First_Name' => $request->First_Name]);
            $client->SB_Eligibility = $request->SB_Eligibility;
        }

        $appt->Client_ID = $client->Client_ID;
        
        $dc = new DayConfiguration('3000-10-20');
        $dcResult = $dc->validateAppointment($appt);
        if (!($dcResult == 'validated')) {
            return redirect()->back()->withInput()->with('scheduleError', $dcResult);
        }

        $client->save();
        $appt->save();

        if (session('pendingAppointment', false)) {
            $this->clearPendingAppointment();
        }
        
        return redirect('/');
    }

    private function clearPendingAppointment() {
        session()->forget('pendingAppointment');
        session()->save();
    }
}