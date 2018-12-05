<?php

namespace App\Http\Controllers\Pantry;

use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    public function showDefault() {
        return view('crud.default-configuration2');
    }

    public function showSpecial() {
        return view('crud.custom-configuration2');
    }
}