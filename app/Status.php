<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function Appointment() {
        return $this->hasMany('App\Appointment', 'Status_ID');
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
    protected $table = 'Status';
    protected $primaryKey = 'Status_ID';
    public $timestamps = false;
}
