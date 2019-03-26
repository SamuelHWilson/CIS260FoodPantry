<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

use App\Availability;
use App\Scheduling\FCEvent;

class AvailabilityDay extends Model
{
    public function availability() {
        return $this->belongsToMany('App\Availability');
    }

    protected $guarded = ['id'];

    public $timestamps = false;

    public function getFCOpenTime() {
        return date_format(new DateTime($this->open_time), FCEvent::$FCTimeFormat);
    }

    public function getFCCloseTime() {
        return date_format(new DateTime($this->close_time), FCEvent::$FCTimeFormat);
    }

    public function getDisplayOpenTime() {
        return date_format(new DateTime($this->open_time), FCEvent::$FCTimeDisplayFormat);
    }

    public function getDisplayCloseTime() {
        return date_format(new DateTime($this->close_time), FCEvent::$FCTimeDisplayFormat);
    }

    public static function findByDate($date) {
        $a = Availability::findByDate($date);
        return $a->availability_days->where('day_number', date_format(new DateTime($date), 'w'))->first();
    }
}
