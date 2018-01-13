<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Skills;
use App\Models\User_Has_Skills;
use Illuminate\Support\Facades\Auth;

use Validator;
use Illuminate\Support\Collection;

class ProfileController extends Controller
{
    public function __construct()
    {

    }

    public function getProfile(Request $request)
    {
      $user = User::find(Auth::user()->id);
      $skill = User::find($user->id)->skills()->get();
      return view("pages.profile",compact('user','skill'));
    }

    public function getUpdateProfile(){
        $user = User::find(Auth::user()->id);
        return view('pages.updateprofile',compact('user','uskill','skills'));
    }

    public function postUpdateProfile(Request $request){
      $validator = Validator::make($request->all(), [
          'name' => 'required',
          'email' => 'required',
          'password' => 'confirmed',
      ]);

      if ($validator->fails()) {
          $errors = new Collection;

          foreach($validator->errors()->toArray() as $errormsg)
          {
              $errors->push($errormsg[0]);
          }
          return redirect()->back()->withErrors($validator);
      }

      $user = User::find(Auth::user()->id);
      $user->name = $request->name;
      $user->email = $request->email;

      if(isset($request->password)){
        $user->password = $request->input('password');
      }
      if (!$user->save())
      {
          return redirect()->back()->withErrors("Unable to create user at this time");
      }
      else
      {
          return redirect()->route('home');
      }

    }

    public function getUpdateSkill(){
      $skills = Skills::all();
      // dd($skills);
      $uskill = User::find(Auth::user()->id)->skills()->get();
      return view('pages.updateskill',compact('uskill','skills'));
    }

    public function postUpdateSkill(Request $request){
      $alluserskills = User::find(Auth::user()->id)->skills()->get()->pluck('id');
      $reqskills = $request->skills;
      $user = User::find(Auth::user()->id);
      $user->skills()->sync($reqskills);

      $skills = Skills::all();
      $uskill = User::find(Auth::user()->id)->skills()->get();

      return view('pages.updateskill',compact('uskill','skills'));
    }




}
