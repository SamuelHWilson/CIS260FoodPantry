<?php

namespace App\Http\Controllers\Pantry;

use App\Client;
use App\Appointment;
use App\Scheduling\AppointmentValidator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function search(Request $request) {
        $validator = Validator::make($request->all(), [
            'First_Name' => 'alpha|nullable',
            'Last_Name' => 'alpha|nullable',
            'Phone_Number' => 'regex:/^\D*(\d\D*){10}$/|nullable',
            'emptyCheck' => 'required_without_all:First_Name,Last_Name,Phone_Number'
        ]);
        if ($validator->fails()) {
            return redirect('clients/search')->withErrors($validator)->withInput();
        }

        $clients = Client::SimpleSearch($request->First_Name, $request->Last_Name, preg_replace('/\D/', '', $request->Phone_Number));

        return view('crud.clients.results', ['clients' => $clients]);
    }

    public function info($id) {
        $client = Client::where('Client_ID', '=', $id)->with('Flags')->first();

        $appts = Appointment::GetForClientUntil($id)->sortByDesc('Appointment_Date');
        $problemIds = [];
        foreach ($appts as $appt) {
            $apptVal = new AppointmentValidator($appt->Appointment_Date);
            if ($apptVal->validateAppointment($appt) != 'validated') {
                $problemIds[] = $appt->Appointment_ID;
            }
        }

        $upcomingAppt = Client::GetNextAppt($id);

        return view('crud.clients.info', ['client' => $client, 'appts' => $appts, 'upcomingAppt' => $upcomingAppt, 'problemIds' => $problemIds]);
    }

    public function updateClient(Request $request) {
        $validator = Validator::make($request->all(), [
            'Client_ID' => 'int|required',
            'First_Name' => 'alpha|required',
            'Last_Name' => 'alpha|required',
            'Phone_Number' => 'regex:/^\D*(\d\D*){10}$/|required',
            'SB_Eligibility' => 'in:0,1|required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $client = Client::findOrFail($request->Client_ID);
        $client->First_Name = $request->First_Name;
        $client->Last_Name = $request->Last_Name;
        $client->Phone_Number = preg_replace('/\D/', '', $request->Phone_Number);
        $client->SB_Eligibility = $request->SB_Eligibility;
        $client->save();

        return redirect()->route('clientInfo', ['id' => $request->Client_ID]);
    }
}