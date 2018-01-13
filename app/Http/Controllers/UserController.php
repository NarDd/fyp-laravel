<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Event;
use App\Models\EventPhotos;
use App\Models\Event_Has_Photos;
use App\Models\Skills;
use App\Models\User;
use App\Models\EventDates;
use App\Models\Event_Has_Users;

use Carbon\Carbon;

use Validator;
use Illuminate\Support\Collection;

class UserController extends Controller
{
    public function __construct()
    {

    }

    public function getUsers(){
      $users = Users::all();
      return response($users);
    }
  }
