<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';

    public function user_has_company(){
       return $this->hasMany('App\Models\User_Has_Company');
    }
}
