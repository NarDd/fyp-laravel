<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Event_Has_Users;
use App\Models\Event_Has_Dates;
use App\Models\Attendance;
use Carbon\Carbon;
use Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;


class EventController extends Controller
{
  public function getUpcoming(){
    $allevents = Event::with('eventdates','photos','users')->get();
    $events = array();
    foreach($allevents as $evt) {
      $lastdate = $evt->eventdates()->orderBy('date', 'desc')->first();
      if ($lastdate->date >= (Carbon::today()->toDateString())) // TODO compare carbon date
      {
        array_push($events, $evt);
      }
    }
    return response($events)->setStatusCode(200);;
  }

  public function getEventAttendance($id, $user){
    $eventdates = Event_Has_Dates::where('event_id', $id)->get();
    // $attendance = Attendance::whereHas('eventdates', function($q) use ($user) {
    //   $q->where('event_has_dates_id', )
    // })
    $attendance = Attendance::where('user_id', $user)->whereHas('eventdates', function($q) use ($id) {
      $q->where('event_id', $id);
    })->get();

    return response($events)->setStatusCode(200);;
  }


  public function getPastEvent()
  {
    $allevents = Event::with('eventdates','photos')->get();
    $events = array();
    foreach($allevents as $evt) {
      $lastdate = $evt->eventdates()->orderBy('date','desc')->first();
      if ($lastdate->date < (Carbon::today()->toDateString())) // TODO compare carbon date
        array_push($events, $evt);
    }
    return response($events)->setStatusCode(200);;
  }

  public function getSecret($id)
  {
    $contact = Event::find($id)->contact_id;
    $contact_per = Event_Has_Users::where("user_id",$contact)->where("event_id",$id)->get();
    return response($contact_per)->setStatusCode(200);
  }

  public function postAttendance(Request $request){
    $attendance = new Attendance;
    $attendance->user_id = $request->user_id;
    $attendance->event_has_dates_id = $request->event_id;
    $attendance->save();
    return response()->json(compact('attendance'));
  }

  public function getMyEvent($id){
    $events = Event::with('eventdates','photos')->has('users', $id)->get();
    return response()->json(compact('events'));
  }

  public function getPresent($id){
    $events = Attendance::with('users')->where('event_has_dates_id', $id)->get();
    return response()->json(compact('events'));
  }

  public function getAbsent($id){
    $events = Attendance::with('users')->where('event_has_dates_id', $id)->get();
    return response()->json(compact('events'));
  }

  public function postVolunteer(Request $request){
    $setEventHasUser = new Event_Has_Users;
    $setEventHasUser->event_id = $request->event["id"];
    $setEventHasUser->user_id = $request->userid;
    $setEventHasUser->save();
    for($i = 0 ; $i < count($request->event["eventdates"]) ; $i++){
      $attendance = new Attendance;
      $attendance->event_has_dates_id = $request->event["eventdates"][$i]['id'];
      $attendance->user_id = $request->userid;
      $attendance->attendance = false;
      $attendance->save();
    }

    return response()->json(compact('setEventHasUser'));

  }

  public function postWithdraw(Request $request){
    $usereventstatus = Event_Has_Users::where('user_id', $request->userid)->where('event_id',$request->event["id"])->delete();
    for($i = 0 ; $i < count($request->event["eventdates"]); $i++){
      $attendance = Attendance::where("event_has_dates_id",$request->event["eventdates"][$i]["id"])->where("user_id",$request->userid)->delete();
    }
    return response()->json(compact('request'));
  }


}
