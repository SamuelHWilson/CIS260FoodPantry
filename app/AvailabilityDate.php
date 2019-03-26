<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvailabilityDate extends Model
{
    public function availability() {
        return $this->belongsTo('App\Availability');
    }

    protected $fillable = ["effective_date"];

    public $timestamps = false;

    public static function findByDate($date) {
        return AvailabilityDate::where("effective_date", "<=", $date)->orderBy("effective_date", "desc")->first();
    }
}
