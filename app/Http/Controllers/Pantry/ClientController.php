<?php

namespace App\Http\Controllers\Pantry;

use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    
    //Show all clients.
    public function showClient()
    {
        return view('crud.editclient');
    }
}