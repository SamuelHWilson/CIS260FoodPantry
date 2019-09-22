<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

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

    public static function SimpleSearch($fname, $lname, $phone) {
        $params = [['First_Name', $fname], ['Last_Name', $lname], ['Phone_Number', $phone]];
        $whereArray = [];

        for ($i = 0; $i < 3; $i++) {
            if ($params[$i][1] != null) {
                $whereArray[] = [$params[$i][0], 'LIKE', '%'.$params[$i][1].'%'];
            }
        }

        return Client::where($whereArray)->get();
    }

    public static function GetNextAppt($id) {
        $today = new DateTime();
        
        $apptCol = Appointment::where([['Client_ID', '=', $id], ['Appointment_Date', '>=', $today]])->with('Status')->orderBy('Appointment_Date')->take(1)->get();
        
        if (!$apptCol->isEmpty()) {
            return $apptCol[0];
        } else {
            return null;
        }
    }

    public function PrettyPhone() {
        $phone = $this->Phone_Number;
        return sprintf("(%s)%s-%s", substr($phone, 0, 3), substr($phone, 3, 3), substr($phone, 6));
    }

    //These are here to override naming convention.
    protected $table = 'Client';
    protected $primaryKey = 'Client_ID';
    public $timestamps = false;
}
