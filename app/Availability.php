<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    public function availability_dates() {
        return $this->hasMany('App\AvailabilityDate');
    }
}
