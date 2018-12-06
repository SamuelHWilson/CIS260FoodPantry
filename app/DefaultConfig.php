<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class DefaultConfig extends Model
{
    
    protected $fillable = [
        'day'
    ];

    public function formatOpenTime($formatString) {
        return date_format(new DateTime($this->openTime), $formatString);
    }

    public function formatCloseTime($formatString) {
        return date_format(new DateTime($this->openTime), $formatString);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    //These are here to override naming convention.
    protected $table = 'default_configuration';
    protected $primaryKey = 'day';
    public $timestamps = false;
}
