<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvailabilityDate extends Model
{
    public function availability() {
        return $this->belongsToMany('App\Availability');
    }

    protected $fillable = ["effective_date"];

    public $timestamps = false;
}
