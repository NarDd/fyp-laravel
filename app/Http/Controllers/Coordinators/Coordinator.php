<?php

namespace App\Http\Controllers\Coordinators;

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
use App\Models\User_Has_Company;


use Validator;
use Illuminate\Support\Collection;

class Coordinator extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getCompany($id){
      $company = Company::find($id);
      $user = User::where('company_id',$id)->get();
      return view("pages.coordinators.viewcompany",compact('company','user'));
    }

    public function postCompany(Request $request){

      if($request->approve){
        $u = User::find($request->approve);
        $u->status = "Approved";
        $u->save();
        $user = User::all();

        return redirect()->back()->withStatus('Form submitted!');
      }

      else{
        $u = User::find($request->reject);
        $u->status = "Rejected";
        $u->save();
        $user = User::all();

        return redirect()->back()->withStatus('Form submitted!');
      }

    
    }
}
