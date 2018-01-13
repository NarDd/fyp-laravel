<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $fillable = [
        'event_name', 'desc', 'event_start', 'event_end', 'location', 'contactid'
    ];
    public function skills(){
       return $this->belongsToMany('App\Models\Skills','event_has_skills', 'event_id', 'skill_id');
    }

    public function users(){
       return $this->belongsToMany('App\Models\User','event_has_users', 'event_id', 'user_id');
    }

    public function photos(){
       return $this->belongsToMany('App\Models\EventPhotos','event_has_photos', 'event_id', 'photo_id');
    }

    public function eventdates(){
       return $this->hasMany('App\Models\Event_Has_Dates');
    }

    public function attendance() {
      return $this->hasManyThrough('App\Models\Attendance', 'App\Models\Event_Has_Dates', 'event_id', 'event_has_dates_id');
    }

    public function pastevent(){
       return $this->hasMany('App\Models\EventDates')->groupBy('event_id')->orderBy('to_date')->latest()->limit(1);
    }

}
