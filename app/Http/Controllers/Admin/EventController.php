<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
// use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\Event;
use App\Models\EventPhotos;
use App\Models\Skills;
use App\Models\User;
use App\Models\EventDates;
use App\Models\Event_Has_Skills;
use App\Models\Event_Has_Dates;
use App\Models\Event_Has_Photos;
use App\Models\Event_Has_Users;
use App\Models\Attendance;
use App\Models\Company;


use Validator;
use Illuminate\Support\Collection;

class EventController extends Controller
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

    public function getCreateEvent(){
        $companies = Company::all();
        $contact_id = User::where('isadmin', "1")->get();
        $special_skills = Skills::all();
        return view("pages.admin.create",compact('contact_id','special_skills','companies'));
    }

    public function getAllEvent(){
      $allevents = Event::with('eventdates','photos')->get();
      $currentEvents = array();
      foreach($allevents as $evt) {
        $lastdate = $evt->eventdates()->orderBy('date', 'desc')->first();
        if ($lastdate->date >= (Carbon::today()->toDateString())) // TODO compare carbon date
        {
          array_push($currentEvents, $evt);
        }
      }
      $pastEvents = array();
      foreach($allevents as $evt) {
        $lastdate = $evt->eventdates()->orderBy('date','desc')->first();
        if ($lastdate->date < (Carbon::today()->toDateString())) // TODO compare carbon date
          array_push($pastEvents, $evt);
      }

      return view("pages.allevents",compact('currentEvents','pastEvents'));
    }

    public function getEditEvent(Request $request, $id)
    {
      $event = Event::where('id',$id)->get()->first();
      $contact = User::find($event->contact_id)->get()->first();
      $dates = Event_Has_Dates::where('event_id',$id)->get();
      $special_skills = Skills::all();
      $photos = Event::find($id)->photos()->get();

      $skills = Event_Has_Skills::where('event_id',$id)->get();
      $admin = User::where('isadmin','1');

      if(isset($skills)){
        if(!isset($photos)){
            return view("pages.admin.edit",compact('event','contact','special_skills','admin','dates','skills'));
        }
        else {
          return view("pages.admin.edit",compact('event','contact','special_skills','admin','dates','skills','photos'));
        }
      }
      else
      {
          if(!isset($photos)){
            return view("pages.admin.edit",compact('event','contact','special_skills','admin','dates'));
          }
          else{
            return view("pages.admin.edit",compact('event','contact','special_skills','admin','dates','photos'));
          }

      }
    }

    public function postCreateEvent(Request $request)
    {

      if($request->corporate){

        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'desc' => 'required',
            'location' => 'required',
            'contact_id' => 'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date.*' => 'required|date|after:today',
            'company' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = new Collection;

            foreach($validator->errors()->toArray() as $errormsg)
            {
                $errors->push($errormsg[0]);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $event = new Event;
        $event->fill($request->all());
        $event->created_by = Auth::user()->id;
        $event->created_at = Carbon::now()->toDateTimeString();
        $event->contact_id = $request->contact_id;
        $event->company_id = $request->company;

        if (!$event->save())
        {
          return redirect()->back()->withErrors('Unable to create event');
        }
        else
        {
          if($request->special_skills != 0){
            foreach($request->special_skills as $skill) {
              $event_skill = new Event_Has_Skills;
              $event_skill->event_id = $event->id;
              $event_skill->skill_id = $skill;

              if(!$event_skill->save()){
                return redirect()->back()->withErrors('Unable to create event');
              }
           }
          }

          $secret = rand(1,9);
          $major = rand(1,9);
          $minor = rand(1,9);

          for($i = 0 ; $i < count($request->date); $i++){
            $event_dates = new Event_Has_Dates;
            $event_dates->event_id = $event->id;
            $event_dates->date = $request->date[$i];
            $event_dates->from_time = $request->start_time[$i].":00";
            $event_dates->to_time = $request->to_time[$i].":00";

            if(!$event_dates->save()){
              return redirect()->back()->withErrors('Unable to create event');
            }

            $cor = new Event_Has_Users;
            $cor->event_id = $event->id;
            $cor->user_id = $request->contact_id;
            $cor->secret = $secret;
            $cor->major = $major;
            $cor->minor = $minor;

            if(!$cor->save()){
              return redirect()->back()->withErrors('Unable to set BLE settings');
            }

            $attendance = new Attendance;
            $attendance->event_has_dates_id = $event_dates->id;
            $attendance->user_id = $request->contact_id;
            $attendance->attendance = true;

            if(!$attendance->save()){
              return redirect()->back()->withErrors('Unable to set attendance');
            }
          }

          if ($request->hasFile('image')) {
            foreach($request->image as $image){
              $imageName = str_random(5).time().'.'.$image->getClientOriginalExtension();
              $image->move(public_path('eventimg'), $imageName);

              $ephoto = new EventPhotos;
              $ephoto->url = $imageName;
              if(!$ephoto->save()){
                return redirect()->back()->withErrors('Unable to upload event photo');
              }
              $esphoto = new Event_Has_Photos;
              $esphoto->event_id = $event->id;
              $esphoto->photo_id = $ephoto->id;
              if(!$esphoto->save()){
                return redirect()->back()->withErrors('Unable to upload event photo');
              }
            }

          }


          return redirect()->route('event.view',['id' => $event->id, 'past' => 0]);
        }
      }
      else{
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'desc' => 'required',
            'location' => 'required',
            'contact_id' => 'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date.*' => 'required|date|after:today'
        ]);

        if ($validator->fails()) {
            $errors = new Collection;

            foreach($validator->errors()->toArray() as $errormsg)
            {
                $errors->push($errormsg[0]);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $event = new Event;
        $event->fill($request->all());
        $event->created_by = Auth::user()->id;
        $event->created_at = Carbon::now()->toDateTimeString();
        $event->contact_id = $request->contact_id;
        if (!$event->save())
        {
          return redirect()->back()->withErrors('Unable to create event');
        }
        else
        {
          if($request->special_skills != 0){
            foreach($request->special_skills as $skill) {
              $event_skill = new Event_Has_Skills;
              $event_skill->event_id = $event->id;
              $event_skill->skill_id = $skill;

              if(!$event_skill->save()){
                return redirect()->back()->withErrors('Unable to create event');
              }
           }
          }

          $secret = rand(1,9);
          $major = rand(1,9);
          $minor = rand(1,9);

          for($i = 0 ; $i < count($request->date); $i++){
            $event_dates = new Event_Has_Dates;
            $event_dates->event_id = $event->id;
            $event_dates->date = $request->date[$i];
            $event_dates->from_time = $request->start_time[$i].":00";
            $event_dates->to_time = $request->to_time[$i].":00";

            if(!$event_dates->save()){
              return redirect()->back()->withErrors('Unable to create event');
            }

            $cor = new Event_Has_Users;
            $cor->event_id = $event->id;
            $cor->user_id = $request->contact_id;
            $cor->secret = $secret;
            $cor->major = $major;
            $cor->minor = $minor;

            if(!$cor->save()){
              return redirect()->back()->withErrors('Unable to set BLE settings');
            }

            $attendance = new Attendance;
            $attendance->event_has_dates_id = $event_dates->id;
            $attendance->user_id = $request->contact_id;
            $attendance->attendance = true;

            if(!$attendance->save()){
              return redirect()->back()->withErrors('Unable to set attendance');
            }
          }

          if ($request->hasFile('image')) {
            foreach($request->image as $image){
              $imageName = str_random(5).time().'.'.$image->getClientOriginalExtension();
              $image->move(public_path('eventimg'), $imageName);

              $ephoto = new EventPhotos;
              $ephoto->url = $imageName;
              if(!$ephoto->save()){
                return redirect()->back()->withErrors('Unable to upload event photo');
              }
              $esphoto = new Event_Has_Photos;
              $esphoto->event_id = $event->id;
              $esphoto->photo_id = $ephoto->id;
              if(!$esphoto->save()){
                return redirect()->back()->withErrors('Unable to upload event photo');
              }
            }

          }


          return redirect()->route('event.view',['id' => $event->id, 'past' => 0]);
        }
      }

    }

//to remove
    public function postUpdateSkill(Request $request){
      $alluserskills = User::find(Auth::user()->id)->skills()->get()->pluck('id');
      $reqskills = $request->skills;
      $user = User::find(Auth::user()->id);
      $user->skills()->sync($reqskills);
      return redirect()->route('home');
    }

    public function postUpdateEvent(Request $request){
      $event = Event::find($request->id);

      // dd($request->all());
      $event = new Event;
      $event->fill($request->all());
      $event->created_by = Auth::user()->id;
      $event->created_at = Carbon::now()->toDateTimeString();
      $event->contact_id = $request->contact_id;

      if (!$event->save())
      {
        return redirect()->back()->withErrors('Unable to create event');
      }
      else
      {
        return redirect()->route('event.view',['id' => $event->id, 'past' => 0]);
      }
    }


}
