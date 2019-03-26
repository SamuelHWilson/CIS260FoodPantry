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
    public function createAvailability() {
        return view('hours.set-hours');
    }

    public function saveAvailability(Request $request) {
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
            'effective_date' => 'required|date',
            'end_date' => 'nullable|date'
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
        if (($validatedData["end_date"] != null) && ($validatedData["effective_date"] > $validatedData["end_date"])) {
            $timeLogicErrors[] = "end_date";
        }
        if (count($timeLogicErrors) > 0) {
            return redirect()->back()->withInput()->with('timeLogicErrors', $timeLogicErrors);
        }

        $availability = new Availability();
        $availability->save();
        
        //TODO: Finish this.
        //TODO: There is no logical validation in this module. They could easily make conflicting AvaialbilityDates.
        if($validatedData["end_date"] != null) {
            $oldADate = AvailabilityDate::findByDate($validatedData['effective_date']);
            $aDateRepeat = new AvailabilityDate();
            $aDateRepeat->availability_id = $oldADate->availability_id;
            $aDateRepeat->effective_date = date('Y-m-d', strtotime($validatedData["end_date"].'+1 day'));
            $aDateRepeat->save();
        }
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

        return redirect('/hours/set-hours');
    }

    public function viewAvailability() {
        $liveDate = new DateTime();
        $date = date_format($liveDate, 'Y-m-d');
        $currentADate = AvailabilityDate::findByDate($date)->load('availability.availability_days');

        $aDates = AvailabilityDate::with('availability.availability_days')->orderBy('effective_date', 'desc')->take(100)->get();

        return view("hours.view-hours", ['currentADate'=>$currentADate, 'allADates' => $aDates]);
    }

    public function confirmDelete($id) {
        $aDate = AvailabilityDate::with('availability.availability_days')->find($id);
        return view("hours.confirm-delete", ['aDate' => $aDate]);
    }

    public function deleteChange(Request $request) {
        $aDate = AvailabilityDate::with('availability.availability_days')->find($request->id);
        $aDateCount = $aDate->availability->availability_dates->count();
        
        if($aDateCount > 1) {
            $aDate->delete();
        } else {
            $aDate->availability->delete();
        }

        return redirect('hours/view-hours');
    }
}
