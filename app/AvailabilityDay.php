<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvailabilityDay extends Model
{
    public function availability() {
        return $this->belongsToMany('App\Availability');
    }

    protected $guarded = ['id'];

    public $timestamps = false;

}
