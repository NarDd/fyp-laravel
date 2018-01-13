<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use App\Models\Skills;
use App\Models\Events;
use App\Models\EventDates;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getHome()
    {
      // $stuff = Event::with('EventDates')->find('1');
      // dd($stuff);
      $events = Event::all();
      return view("pages.home",compact('events'));
    }


}
