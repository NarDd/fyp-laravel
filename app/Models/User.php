<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable
{
  use Notifiable;

  protected $table = 'users';

  const ADMIN_TRUE = true;
  const ADMIN_FALSE = false;
  const APPROVED_TRUE = "Approved";
  const APPROVED_FALSE = "Rejected";
  const APPROVED_PENDING = "Pending";
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'email'
  ];

  protected $attributes = [
       'isadmin' => self::ADMIN_FALSE,
       'status' => self::APPROVED_PENDING,
   ];
  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */

   public function setPasswordAttribute($password){
      $this->attributes['password'] = bcrypt($password);
   }

   protected static function boot(){
        parent::boot();

        User::creating(function ($user) {
          // $user->approved_date =  Carbon::now();
      });

    }

  public function setUsernameAttribute($email){
      $this->attributes['email'] = strtolower($email);
  }

  public function skills(){
     return $this->belongsToMany('App\Models\Skills','user_has_skills', 'user_id', 'skill_id');
  }

  public function users(){
     return $this->belongsToMany('App\Models\Skills','event_has_users', 'event_id', 'user_id');
  }

}
