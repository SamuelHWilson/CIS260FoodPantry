<?php

namespace App\Http\Controllers\Pantry;

use DateTime;
use App\Availability;
use App\AvailabilityDate;
use App\AvailabilityDay;
use App\Scheduling\FCEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AvailabilityController extends Controller
{
    public function showDefault() {
        return view('hours.set-hours');
    }

    public function setDefault(Request $request) {
        $validatedData = $request->validate([
            'day_number.*' => 'required|integer|min:0|max:6',
            'openHour.*' => 'required|integer|min:1|max:12',
            'closeHour.*' => 'required|integer|min:1|max:12',
            'openMinute.*' => 'required|in:00,15,30,45',
            'closeMinute.*' => 'required|in:00,15,30,45',
            'openAmpm.*' => 'required|in:AM,PM',
            'closeAmpm.*' => 'required|in:AM,PM',
            'available_staff.*' => 'required|integer|min:1|max:255',
            'is_open.*' => 'required|bool',
            'effective_date' => 'required|date'
        ]);
        
        $timeLogicErrors = [];
        foreach($validatedData['day_number'] as $day_number) {
            if($validatedData['is_open'][$day_number] == true) {
                $openTime = new DateTime($validatedData['openHour'][$day_number].':'.$validatedData['openMinute'][$day_number].$validatedData['openAmpm'][$day_number]);
                $closeTime = new DateTime($validatedData['closeHour'][$day_number].':'.$validatedData['closeMinute'][$day_number].$validatedData['closeAmpm'][$day_number]);

                if($openTime >= $closeTime) {
                    $timeLogicErrors[] = $day_number;
                }
            }
        }
        if (count($timeLogicErrors) > 0) {
            return redirect()->back()->withInput()->with('timeLogicErrors', $timeLogicErrors);
        }

        $availability = new Availability();
        $availability->save();
        
        $availability->availability_dates()->create([
            'effective_date' => $validatedData['effective_date']
        ]);

        for($day_number = 0; $day_number < 7; $day_number++) {
            $availability->availability_days()->create([
                'day_number' => $day_number,
                'is_open' => $validatedData['is_open'][$day_number],
                'open_time' => date_format(new DateTime($validatedData['openHour'][$day_number].':'.$validatedData['openMinute'][$day_number].$validatedData['openAmpm'][$day_number]), FCEvent::$FCTimeFormat),
                'close_time' => date_format(new DateTime($validatedData['closeHour'][$day_number].':'.$validatedData['closeMinute'][$day_number].$validatedData['closeAmpm'][$day_number]), FCEvent::$FCTimeFormat),
                'available_staff' => $validatedData['available_staff'][$day_number]
            ]);
        }

        return redirect('/testing/default-configuration');
    }
}
