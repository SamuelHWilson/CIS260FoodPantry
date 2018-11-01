<?php

namespace App\Http\Controllers\Pantry;

use App\Status;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    
    //Show all clients.
    public function index()
    {
        return view('testing.status-dump', ['statuses' => Status::with('Appointment')->get()]);
    }
}