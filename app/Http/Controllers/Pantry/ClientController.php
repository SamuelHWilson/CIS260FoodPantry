<?php

namespace App\Http\Controllers\Pantry;

use App\Client;
use App\Appointment;
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

        $clients = Client::SimpleSearch($request->First_Name, $request->Last_Name, $request->Phone_Number);

        return view('crud.clients.results', ['clients' => $clients]);
    }

    public function info($id) {
        $client = Client::findOrFail($id);
        $appts = Appointment::GetForClientUntil($id);

        return view('crud.clients.info', ['client' => $client, 'appts' => $appts]);
    }

    //Show all clients.
    public function showClient()
    {
        return view('crud.editclient');
    }
}