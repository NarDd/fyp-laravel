<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Auth;
use Log;

class UserController extends Controller
{
  public function __construct(){
  }

  public function postSignIn(Request $request){
    $creds = [
        'email' 	   => $request->email,
        'password' => $request->password
    ];

    if (Auth::attempt($creds)) {
       $userid = auth()->user()->id;
       $user = User::with('skills')->find($userid);
       return response()->json(compact('user'));
    }
    else{
      $errors = "Wrong Credentials";
      $status_code = 500;
      return response()->json(compact('errors'))->setStatusCode(500);
    }
  }

  public function getCompanies(){
    $companies = Company::all();
    return response()->json(compact('companies'))->setStatusCode(200);
  }

  public function getUsers(){
    $users = User::find(1);
    return response($users);
  }

  public function getUserData($id){
    $user = User::with('skills')->find($id);
    return response()->json(compact('user'));
  }



  public function createUser(Request $request){
    if($request->corporate == true){
      $validator = Validator::make($request->all(), [
          'name' => 'required',
          'email' => 'required|email|unique:users',
          'password' => 'required',
          'company' => 'required',
      ]);

      if ($validator->fails()) {
          $errors = new Collection;

          foreach($validator->errors()->toArray() as $errormsg)
          {
              $errors->push($errormsg[0]);
          }
          return response()->json(compact('errors', 'status_code'))->setStatusCode(500);
      }

      $user = new User;
      $user->fill($request->all());
      $user->password = $request->password;
      $user->api_token = str_random(60);
      $user->company_id = $request->company;
      if (!$user->save())
      {
          return response()->json(compact('errors', 'status_code'))->setStatusCode(500);
      }
      else
      {
           return response()->json(compact('user'));
      }

    }
    else{
      $validator = Validator::make($request->all(), [
          'name' => 'required',
          'email' => 'required|email|unique:users',
          'password' => 'required',
      ]);

      if ($validator->fails()) {
          $errors = new Collection;

          foreach($validator->errors()->toArray() as $errormsg)
          {
              $errors->push($errormsg[0]);
          }
          return response()->json(compact('errors', 'status_code'))->setStatusCode(500);
      }

      $user = new User;
      $user->fill($request->all());
      $user->password = $request->password;
      $user->company_id = 0;
      $user->api_token = str_random(60);
      if (!$user->save())
      {
          return response()->json(compact('errors', 'status_code'))->setStatusCode(500);
      }
      else
      {
           return response()->json(compact('user'));
      }

    }


  }

}
