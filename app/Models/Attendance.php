<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';

    public function eventdates(){
       return $this->belongsTo('App\Models\Event_Has_Dates', 'event_has_dates_id');
    }

    public function users(){
       return $this->belongsTo('App\Models\User', 'user_id');
    }
}
