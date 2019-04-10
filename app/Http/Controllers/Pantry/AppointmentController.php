<?php

namespace App\Http\Controllers\Pantry;

use DateTime;
use Illuminate\Http\Request;
use App\Appointment;
use App\Client;
use App\AvailabilityDay;
use App\Http\Controllers\Controller;
use App\Scheduling\FCEvent;
use App\Scheduling\FCDayInfo;
use App\Scheduling\PendingAppointment;
use App\Scheduling\AppointmentValidator;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function showCreateForm($date) {
        return view('crud.schedule-appointment')->with(['date' => $date]);
    }

    public function viewAppointment($id) {
        $now = new DateTime();
        $appt = Appointment::with(['Client', 'Client.Flags' => function($query) use ($now) {
            $query->where('Flag_EXP', '>', $now);
        }])->where('Appointment_ID', $id)->first();
        return view('crud.view-appointment', ['appt' => $appt]);
    }

    public function showDay($date) {
        $liveDate = new DateTime($date);
        $appointments = Appointment::where('Appointment_Date', $liveDate)->get();
        $aDay = AvailabilityDay::findByDate($date);

        //Unfortunatly, it is a requirement that I validate appointments here.
        //This way, I can display erroneous appointments in the day view.
        $validator = new AppointmentValidator($date);
        $fcEvents = [];
        $earlyTimes = [];
        $lateTimes = [];
        foreach ($appointments as $appt) {
            $status = $validator->validateAppointment($appt, false);
            $problem = ($status != "validated");

            $fcEvent = FCEvent::createFromAppt($appt, $problem);

            if ($status == "beforeOpen") { $earlyTimes[] = $fcEvent->start; };
            if ($status == "afterClose") { $lateTimes[] = $fcEvent->start; };
            if ($status == "closed") { $earlyTimes[] = $fcEvent->start; $lateTimes[] = $fcEvent->start; };

            $fcEvents[] = $fcEvent;
        }

        $overrideMinTime = null;
        if(!empty($earlyTimes)) {
            $overrideMinTime = min($earlyTimes);
            //TODO: This is terrible practice. This line needs to be way shorter.
            $fcEvents[] = FCEvent::createMarker('Openning time.', date_format(new DateTime($liveDate->format(FCEvent::$FCDateFormat)." ".$aDay->getFCOpenTime()),FCEvent::$FCStartFormat));
        }
        $overrideMaxTime = null;
        if(!empty($lateTimes)) {
            $overrideMaxTime = date_format(new DateTime(max($lateTimes)." +15 minutes"),FCEvent::$FCTimeFormat);
            //TODO: This is terrible practice. This line needs to be way shorter.
            $fcEvents[] = FCEvent::createMarker('Closing time.', date_format(new DateTime($liveDate->format(FCEvent::$FCDateFormat)." ".$aDay->getFCCloseTime()),FCEvent::$FCStartFormat));
        }
        
        //Easier to do date math in php, so I pass dates to the page from here.
        $nextDate = date(FCEvent::$FCDateFormat, strtotime($date.' +1 day'));
        $prevDate = date(FCEvent::$FCDateFormat, strtotime($date.' -1 day'));

        return view('appointment-calendar', 
                        ['view' => 'day', 
                         'currentDate'=> $date, 
                         'nextDate' => $nextDate, 
                         'prevDate' => $prevDate,
                         'appointments' => json_encode($fcEvents),
                         'isOpen' => $aDay->is_open,
                         'minTime' => $overrideMinTime ? $overrideMinTime : $aDay->getFCOpenTime(),
                         'maxTime' => $overrideMaxTime ? $overrideMaxTime : $aDay->getFCCloseTime()]);
    }
    
    public function showMonth($date) {
        //I perform the date math here in php because I have access to the modular FCEvent::$FCDateFormat property.
        $liveDate = new DateTime($date);
        $nextDate = date(FCEvent::$FCDateFormat, strtotime($date.' +1 month'));
        $prevDate = date(FCEvent::$FCDateFormat, strtotime($date.' -1 month'));

        $results = DB::table('Appointment')
                        ->select('Appointment_Date', DB::raw('count(*) as total'))
                        ->groupBy('Appointment_Date')
                        ->whereYear('Appointment_Date', $liveDate->format('Y'))
                        ->whereMonth('Appointment_Date', $liveDate->format('m'))
                        ->get();

        $daySummaries = [];      
        foreach($results as $result) {
            $daySummaries[] = new FCDayInfo($result->Appointment_Date, $result->total);
        }

        //Do something about this. Month view does not logically use isOpen, minTime, or maxTime, but will crash without them.
        return view('appointment-calendar', ['view' => 'month', 
                                             'currentDate'=> $date, 
                                             'nextDate' => $nextDate, 
                                             'prevDate' => $prevDate,
                                             'appointments' => json_encode($daySummaries, true),
                                             'isOpen' => true,
                                             'minTime' => "00:00:00",
                                             'maxTime' => "00:00:00"]);
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
        $now = new DateTime();

        $client = Client::where('Client_ID', $request->input('clientID'))->with(['Flags' => function($query) use($now) {
            $query->where('Flag_EXP', '>', $now);
        }])->first();

        if ($request->input('apptID', false)) {
            $appt = Appointment::findOrFail($request->input('apptID'));
        } else {
            $appt = null;
        }

        $penappt = new PendingAppointment($client, $appt);
        $penappt->float();

        //Jumps forward from today's date because appointments will always be checked in today.
        $redirectDate = new DateTime();
        if ($request->input('jumpString', false)) {
            $redirectDate->modify($request->input('jumpString'));
        }

        return redirect('/appointments/day-view/'.$redirectDate->format(FCEvent::$FCDateFormat));
    }

    public function cancelPendingAppointment() {
        PendingAppointment::get()->cancel();
        return redirect('/');
    }

    public function cancel(Request $request) {
        $appt = Appointment::findOrFail($request->id);
        $appt->Cancel();
        return redirect('/appointments/day-view/'.$appt->Appointment_Date);
    }

    public function restore(Request $request) {
        $appt = Appointment::findOrFail($request->id);
        $appt->Restore();
        return redirect('/appointments/day-view/'.$appt->Appointment_Date);
    }

    public function createAppointment(Request $request) {
        $validatedData = $request->validate([
            'Appointment_Date' => 'required|date',
            'First_Name' => 'required|alpha',
            'Last_Name' => 'required|alpha',
            'Phone_Number' => 'required|regex:/^[0-9]{10}$/',
            'SB_Eligibility' => 'required|bool',
            'Appointment_Note' => "regex:/^[A-Za-z0-9!?, \.\']*$/|nullable",

            'hour' => 'required|between:1,12',
            'minute' => 'required|in:00,15,30,45',
            'ampm' => 'required|in:am,pm'
        ]);

        $fullTime = new DateTime($request->hour.":".$request->minute.$request->ampm);
        //TODO: Why did I use time(7) in the DB. Who cares about miliseconds? Oh well. Adding .0000000 to the string will work for now.
        $FCTime = $fullTime->format(FCEvent::$FCTimeFormat).'.0000000';
        
        $appt = new Appointment();
        $appt->Status_ID = Appointment::$PendingStatus;
        $appt->Appointment_Date = $request->Appointment_Date;
        $appt->Appointment_Time = $FCTime; //I changed this recently. If everything breaks, this is why.
        $appt->Appointment_Note = $request->Appointment_Note;

        //It's weird that we still get client input even if we have the ID, but having all the client
        //fields always visible makes it easier for the volunteers to use the software.

        //It would be a pain to render the information, but only submit it when we don't have a Client_ID,
        //so we just ignore the input when we do.
        if (PendingAppointment::exists()) {
            $client = PendingAppointment::get()->client;
        } else {
            // dd($request->First_Name);
            $client = Client::firstOrCreate(
                ['Phone_Number' => $request->Phone_Number,
                 'Last_Name' => $request->Last_Name,
                 'First_Name' => $request->First_Name]);
            $client->SB_Eligibility = $request->SB_Eligibility;
        }

        $appt->Client_ID = $client->Client_ID;
        
        if($request->overrideScheduleError != true) {
            $validator = new AppointmentValidator($appt->Appointment_Date, true);
            $result = $validator->validateAppointment($appt);
            if (!($result == 'validated')) {
                return redirect()->back()->withInput()->with('scheduleError', $result);
            }
        }

        $client->save();
        $appt->save();

        if (PendingAppointment::exists()) {
            PendingAppointment::get()->close();
        }
        
        return redirect('/');
    }
}