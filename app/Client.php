<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function Appointment() {
        return $this->hasMany('App\Appointment', 'Client_ID');
    }

    public function Flags() {
        return $this->hasMany('App\Flag', 'Client_ID');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'First_Name',
        'Last_Name',
        'Phone_Number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    //These are here to override naming convention.
    protected $table = 'Client';
    protected $primaryKey = 'Client_ID';
    public $timestamps = false;
}
