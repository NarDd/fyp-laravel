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
use App\Models\User_Has_Company;


use Validator;
use Illuminate\Support\Collection;

class CompanyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getCompanies(){
      $coordinators = array();
      $companies = Company::with('user_has_company')->get();
      foreach($companies as $com){
          $coordinatorid = $com->user_has_company[0]->user_id;
          array_push($coordinators, User::find($coordinatorid));
      }

      $users = User::all();
      return view("pages.admin.managecompanies",compact('coordinators','companies','users'));
    }

    public function getCompanyAdd(){
        $users = User::all();
        return view("pages.admin.addcompany",compact('users'));
    }

    public function postCompaniesAdd(Request $request){
      $validator = Validator::make($request->all(), [
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

      $company = new Company;
      $company->name = $request->company;
      if(!$company->save()){
        return redirect()->back()->withErrors('Unable to set add new company');
      }
      $userC = new User_Has_Company;
      $userC->user_id = $request->user;
      $userC->isCoordinator = true;
      $userC->company_id = $company->id;
      if(!$userC->save()){
        return redirect()->back()->withErrors('Unable to set add coordinator');
      }

      $coordinator = User::find($request->user);

      $coordinator->company_id = $company->id;
      $coordinator->status = "Approved";

      if(!$coordinator->save()){
        return redirect()->back()->withErrors('Unable to set add coordinator');
      }

      $coordinators = array();
      $companies = Company::with('user_has_company')->get();
      foreach($companies as $com){
          $coordinatorid = $com->user_has_company[0]->user_id;
          array_push($coordinators, User::find($coordinatorid));
      }

      $users = User::all();
      return view("pages.admin.managecompanies",compact('coordinators','companies','users'));
    }



}
