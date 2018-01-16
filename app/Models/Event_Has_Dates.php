<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event_Has_Dates extends Model
{
    protected $table = 'event_has_dates';

    public function attendance(){
       return $this->hasMany('App\Models\Attendance', 'event_has_dates_id', 'id' );
    }

}
