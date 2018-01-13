<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPhotos extends Model
{
    protected $table = 'event_photos';

    public function user(){
       return $this->belongsToMany('App\Models\User');
    }

    public function skills(){
       return $this->belongsToMany('App\Models\Skills','user_has_skills', 'user_id', 'skill_id');
    }

    public function photos(){
       return $this->belongsToMany('App\Models\EventPhotos','event_has_photos', 'event_id', 'photo_id');
    }

    public function event_has_photos(){
      return $this->belongsTo('App\Models\Event_Has_Photos');
    }

}
