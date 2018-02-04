<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Event;
use App\Models\EventPhotos;
use App\Models\Event_Has_Photos;
use App\Models\Skills;
use App\Models\User;
use App\Models\EventDates;
use App\Models\Event_Has_Users;
use App\Models\Event_Has_Dates;
use App\Models\Attendance;


use Carbon\Carbon;

use Validator;
use Illuminate\Support\Collection;

class EventController extends Controller
{
    public function __construct()
    {

    }

    public function getUpcomingEvent()
    {
      if(Auth::check()){
        $user = User::find(Auth::id());
        if($user->isadmin == 1){
          $allevents = Event::with('eventdates')->get();
        }
        else{
          if($user->status == "Approved"){
            $allevents = Event::with('eventdates')->where('company_id',$user->company_id)->orWhereNull('company_id')->get();
          }
          else{
            $allevents = Event::with('eventdates')->whereNull('company_id')->get();
          }
        }
      }
      else{
        $allevents = Event::with('eventdates')->whereNull('company_id')->get();
      }
      $events = array();
      foreach($allevents as $evt) {
        $lastdate = $evt->eventdates()->orderBy('date', 'desc')->first();
        if ($lastdate->date >= (Carbon::today()->toDateString())) // TODO compare carbon date
        {
          array_push($events, $evt);
        }
      }
      return view('pages.upcoming',compact('events'));
    }

    public function getPastEvent()
    {
      if(Auth::check()){
        $user = User::find(Auth::id());
        if($user->isadmin == 1){
          $allevents = Event::with('eventdates')->get();
        }
        else{
          if($user->status == "Approved"){
            $allevents = Event::with('eventdates')->where('company_id',$user->company_id)->orWhereNull('company_id')->get();
          }
          else{
            $allevents = Event::with('eventdates')->whereNull('company_id')->get();
          }
        }
      }
      else{
        $allevents = Event::with('eventdates')->whereNull('company_id')->get();
      }
      $events = array();
      foreach($allevents as $evt) {
        $lastdate = $evt->eventdates()->orderBy('date','desc')->first();
        if ($lastdate->date < (Carbon::today()->toDateString())) // TODO compare carbon date
          array_push($events, $evt);
      }
      return view('pages.past',compact('events'));
    }

    public function getEvent(Request $request, $id, $past)
    {
      $event = Event::find($id);
      $photo =  Event::find($id)->photos()->get();
      $dates = Event::find($id)->eventdates()->get();
      $skill = Event::find($id)->skills()->get();

      if(Auth::check()){
        $user = Auth::id();
        if($event->company_id){
          if(Auth::user()->isadmin == 1){
             $isadmin = 1;
             $eventUserStatus = Event_Has_Users::where('user_id', $user)->where('event_id',$request->id)->get()->first();
             if($eventUserStatus){
               $status = 1;
             }
             else{
               $status = 0;
             }

             $past = 0;

             return view("pages.event",compact('event','dates','skill','photo','user','status','past','isadmin'));
          }
          elseif(Auth::user()->company_id == $event->company_id){
            $isadmin = 0;
            $eventUserStatus = Event_Has_Users::where('user_id', $user)->where('event_id',$request->id)->get()->first();
            if($eventUserStatus){
              $status = 1;
            }
            else{
              $status = 0;
            }

            $past = 0;
            return view("pages.event",compact('event','dates','skill','photo','user','status','past','isadmin'));
          }

          else{
            return response()->view('errors.403');
          }
        }
        //not company event
        else{
          if(Auth::user()->isadmin == 1){
             $isadmin = 1;
           }
         else{
            $isadmin = 0;
          }

         $eventUserStatus = Event_Has_Users::where('user_id', $user)->where('event_id',$request->id)->get()->first();
         if($eventUserStatus){
           $status = 1;
         }
         else{
           $status = 0;
         }

         $past = 0;

         return view("pages.event",compact('event','dates','skill','photo','user','status','past','isadmin'));

        }
        }
        else{
          $isadmin = 0;
          $user = "";
          $past = 0;
          $status = 0;

          return view("pages.event",compact('event','dates','skill','photo','user','status','past','isadmin'));

        }

      }








    public function postVolunteer(Request $request){
      if($request->submit == "Volunteer"){
        $volunteerExist = Event_Has_Users::where('user_id', $request->user)->where('event_id',$request->id)->get()->first();
        if(!$volunteerExist){
            $eventusers = new Event_Has_Users;
            $eventusers->event_id = $request->id;
            $eventusers->user_id = $request->user;
            if(!$eventusers->save()){
              return redirect()->back()->withErrors('Unable to volunteer for event');
            }


            $countDates = Event_Has_Dates::where('event_id', $request->id)->get();
            for($i = 0 ; $i < count($countDates); $i++){
              $attendance = new Attendance;
              $attendance->event_has_dates_id = $countDates[$i]->id;
              $attendance->user_id = $request->user;
              $attendance->attendance = false;
              if(!$attendance->save()){
                return redirect()->back()->withErrors('Internal Error has occured');
              }
            }

            $event = Event::find($request->id);
            $photo =  Event::find($request->id)->photos()->get();
            $dates = Event::find($request->id)->eventdates()->get();
            $skill = Event::find($request->id)->skills()->get();
            $u = $request->user;
            $useracc = Auth::user($u);

            if($useracc->isadmin == 1)
            {
              $isadmin = 1;
            }
            else {
              $isadmin = 0;
            }
            $user = $useracc->id;
            $eventUserStatus = Event_Has_Users::where('user_id', $request->user)->where('event_id',$request->id)->get()->first();
            if($eventUserStatus){
              $status = 1;
            }
            else{
              $status = 0;
            }
              $past = 0;

              return view("pages.event",compact('event','dates','skill','photo','user','status','past','isadmin'));
          }
          return redirect()->back();
        }
        else{
          $volunteerExist = Event_Has_Users::where('user_id', $request->user)->where('event_id',$request->id)->get()->first();
          if($volunteerExist){
          $countDates = Event_Has_Dates::where('event_id', $request->id)->get();
          for($i = 0 ; $i < count($countDates); $i++){
            $attendance = Attendance::where("event_has_dates_id",$countDates[$i]->id)->where("user_id",$request->user)->delete();
          }

          $user =  Event_Has_Users::where('user_id', $request->user)->where('event_id',$request->id)->get()->first();
          if(!$user->delete()){
            return redirect()->back()->withErrors('Unable to withdraw for event');
          }

          $event = Event::find($request->id);
          $photo =  Event::find($request->id)->photos()->get();
          $dates = Event::find($request->id)->eventdates()->get();
          $skill = Event::find($request->id)->skills()->get();
          $u = $request->user;
          $useracc = Auth::user($u);

          if($useracc->isadmin == 1)
          {
            $isadmin = 1;
          }
          else {
            $isadmin = 0;
          }
          $user = $useracc->id;

          $usereventstatus = Event_Has_Users::where('user_id', $request->user)->where('event_id',$request->id)->get()->first();
          if($usereventstatus){
            $status = 1;
          }
          else{
            $status = 0;
          }

        $past = 0;
        return view("pages.event",compact('event','dates','skill','photo','user','status','past','isadmin'));
      }
      else {
        return redirect()->back();
      }
    }

    }

}
