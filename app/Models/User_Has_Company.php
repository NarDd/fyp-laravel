<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Has_Company extends Model
{
    protected $table = 'users_has_company';

    public function company(){
       return $this->belongsTo('App\Models\Company');
    }

    public function users(){
       return $this->belongsTo('App\Models\User');
    }

}
