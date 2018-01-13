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


use Validator;
use Illuminate\Support\Collection;

class SkillsController extends Controller
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

    public function getSkills(){
        $contact_id = User::where('isadmin', "0")->get();
        $special_skills = Skills::all();
        // dd($special_skills);
        return view("pages.admin.create")->with('contact_id',$contact_id)->with('special_skills',$special_skills);
    }

    public function postCreateSkills(Request $req){
        foreach($req->skill_name as $sk){
        $skill = new Skills;
        $skill->skill_name = $sk;
        $skill->save();
      }
      $skills = Skills::all();
      return view("pages.admin.createskill",compact('skills'));
    }

    public function getCreateSkills(){
        $skills = Skills::all();
        return view("pages.admin.createskill",compact('skills'));
    }



}
