<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public function Client() {
        return $this->belongsTo('App\Client', 'Client_ID');
    }

    public function Status() {
        return $this->belongsTo('App\Status', 'Status_ID');
    }

    public function GetDateTime() {
        $dt = new DateTime($this->Appointment_Date." ".$this->Appointment_Time);
        return $dt;
    }

    public function GetFullName() {
        return $this->client->First_Name." ".$this->client->LastName;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    //These are here to override naming convention.
    protected $table = 'Appointment';
    protected $primaryKey = 'Appointment_ID';
    public $timestamps = false;
}
