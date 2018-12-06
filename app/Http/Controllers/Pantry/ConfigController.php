<?php

namespace App\Http\Controllers\Pantry;

use DateTime;
use App\DefaultConfig;
use App\Scheduling\FCEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    public function showDefault() {
        $defCons = DefaultConfig::all();
        return view('config.default-configuration2')->with('defCons', $defCons);
    }

    public function showSpecial() {
        return view('config.custom-configuration2');
    }

    public function setDefault(Request $request) {
        // dd($request);
        $validatedData = $request->validate([
            'dayNum.*' => 'required|integer|min:0|max:6',
            'openHour.*' => 'required|integer|min:1|max:12',
            'closeHour.*' => 'required|integer|min:1|max:12',
            'openMinute.*' => 'required|in:00,15,30,45',
            'closeMinute.*' => 'required|in:00,15,30,45',
            'openAmpm.*' => 'required|in:AM,PM',
            'closeAmpm.*' => 'required|in:AM,PM',
            'numOfVol.*' => 'required|integer|min:1|max:255',
            'isOpen.*' => 'required|bool'
        ]);
        // dd($validatedData);
        
        $timeLogicErrors = [];
        foreach($validatedData['dayNum'] as $dayNum) {
            $openTime = new DateTime($validatedData['openHour'][$dayNum].':'.$validatedData['openMinute'][$dayNum].$validatedData['openAmpm'][$dayNum]);
            $closeTime = new DateTime($validatedData['closeHour'][$dayNum].':'.$validatedData['closeMinute'][$dayNum].$validatedData['closeAmpm'][$dayNum]);

            if($openTime >= $closeTime) {
                $timeLogicErrors[] = $dayNum;
            }
        }
        if (count($timeLogicErrors) > 0) {
            return redirect()->back()->withInput()->with('timeLogicErrors', $timeLogicErrors);
        }

        for($dayNum = 0; $dayNum < 7; $dayNum++) {
            $defCon = DefaultConfig::firstOrNew(['day' => $dayNum]);

            $defCon->isOpen = $validatedData['isOpen'][$dayNum];
            
            $openTime = date_format(new DateTime($validatedData['openHour'][$dayNum].':'.$validatedData['openMinute'][$dayNum].$validatedData['openAmpm'][$dayNum]), FCEvent::$FCTimeFormat);
            $closeTime = date_format(new DateTime($validatedData['closeHour'][$dayNum].':'.$validatedData['closeMinute'][$dayNum].$validatedData['closeAmpm'][$dayNum]), FCEvent::$FCTimeFormat);
            $defCon->openTime = $openTime;
            $defCon->closeTime = $closeTime;

            $defCon->numOfVol = $validatedData['numOfVol'][$dayNum];

            $defCon->save();
        }

        return redirect('/testing/default-configuration');
    }
}