<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    protected $table = 'skills';

    public function User(){
       return $this->belongsToMany('App\Models\User');
    }

    public function event(){
       return $this->belongsToMany('App\Models\Event');
    }

  
}
