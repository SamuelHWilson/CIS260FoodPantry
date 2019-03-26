<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AvailabilityDate;

class Availability extends Model
{
    public function availability_dates() {
        return $this->hasMany('App\AvailabilityDate');
    }

    public function availability_days() {
        return $this->hasMany('App\AvailabilityDay');
    }

    public function delete() {
        $this->availability_dates()->delete();
        $this->availability_days()->delete();
        return parent::delete();
    }

    // public $timestamps = false;

    public static function findByDate($date) {
        $aDate = AvailabilityDate::findByDate($date);
        return $aDate->availability;
    }
}
