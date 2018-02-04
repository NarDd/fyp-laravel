<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use App\Models\Skills;
use App\Models\Events;
use App\Models\EventDates;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
      $events = Event::whereNull('company_id')->get();
      $slickphotos = Event::with("photos")->whereNull('company_id')->orderBy('id','desc')->take(5)->get();


      return view("pages.home",compact('events','slickphotos'));
    }


}
