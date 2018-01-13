<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventDates extends Model
{
    protected $table = 'event_has_dates';

    public function event(){
       return $this->belongsTo('App\Models\Event');
    }



}
