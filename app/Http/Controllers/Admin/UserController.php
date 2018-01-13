<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\User;

use Validator;
use Illuminate\Support\Collection;

class UserController extends Controller
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

    public function getUserList(){
      // $pending = User::where('status', User::APPROVED_PENDING)->get();
      // $approved = User::where('status', User::APPROVED_TRUE)->get();
      // $rejected = User::where('status', User::APPROVED_FALSE)->get();
      $user = User::all();

      return view("pages.admin.userlist", compact('user'));
    }

    public function getUser(Request $request, $id){
       $user = User::find($id);

       return view("pages.admin.user",compact('user'));
    }


    public function postUserList(Request $request){

      $u = User::find($request->id);
      if($u->isadmin == true){
        $u->isadmin = false;
      }
      else {
        $u->isadmin = true;
      }
      $u->save();
      $user = User::all();

      return view("pages.admin.userlist", compact('user'));
    }

    public function userApproval(Request $request, $id){

      $user = User::find($id);
      switch($request->submitbtn){
        case 'Approve':
        {
          $user->status = User::APPROVED_TRUE;
          $user->status_updated_by = Auth::user()->id;;
          $user->status_updated_at = Carbon::now()->toDateTimeString();
          $user->save();
          return redirect()->route('home');
        }
        case 'Reject':
        {
          $validator = Validator::make($request->all(), [
              'reason' => 'required',
          ]);

          if ($validator->fails()) {
              $errors = new Collection;

              foreach($validator->errors()->toArray() as $errormsg)
              {
                  $errors->push($errormsg[0]);
              }
                return redirect()->back()->withErrors($validator);
          }

          $user->status = User::APPROVED_FALSE;
          $user->status_updated_by = $request->user()->id;
          $user->status_updated_at = Carbon::now()->toDateTimeString();
          $user->save();
          return redirect()->route('home');
        }

      }


    }



}
