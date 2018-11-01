<?php

namespace App\Http\Controllers\Pantry;

use App\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    
    //Show all clients.
    public function index()
    {
        return view('testing.appointment-dump', ['appointments' => Appointment::with('Client', 'Status')->get()]);
    }
}