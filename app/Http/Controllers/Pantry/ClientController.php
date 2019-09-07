<?php

namespace App\Http\Controllers\Pantry;

use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function search(Request $request) {
        $validatedData = $request->validate([
            'First_Name' => 'alpha|nullable',
            'Last_Name' => 'alpha|nullable',
            'Phone_Number' => 'regex:/^\D*(\d\D*){10}$/|nullable',
            'emptyCheck' => 'required_without_all:First_Name,Last_Name,Phone_Number'
        ]);

        dd(Client::SimpleSearch($request->First_Name, $request->Last_Name, $request->Phone_Number));
    }

    //Show all clients.
    public function showClient()
    {
        return view('crud.editclient');
    }
}