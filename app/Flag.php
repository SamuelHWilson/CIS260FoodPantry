<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flag extends Model
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
        'Client_ID',
        'Flag_DES'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    //These are here to override naming convention.
    protected $table = 'Flag';
    protected $primaryKey = 'Flag_ID';
    public $timestamps = false;
}
