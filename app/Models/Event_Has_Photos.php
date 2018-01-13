<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event_Has_Photos extends Model
{
    protected $table = 'event_has_photos';

    public function photos(){
       return $this->hasMany('App\Models\EventPhotos','id');
    }

}
