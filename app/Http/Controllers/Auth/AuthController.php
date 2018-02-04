<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;

use Session;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use Illuminate\Support\Collection;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    public function postLogin(Request $request)
    {
      $creds = [
          'email' 	   => $request->input("email"),
          'password' => $request->input("password")
      ];

      if (Auth::attempt($creds)) {
          return redirect()->intended('/');
      }
      $request->session()->flash('Invalid Credentials', 'Wrong username or password');
      return redirect()->back();
    }

    public function postLogout(Request $request)
    {
      Auth::logout();
      Session::flush();
      return redirect()->route('home');
    }

    public function getRegister(){
      $companies = Company::all();
      return view('pages.register',compact('companies'));
    }

    public function postRegister(Request $request)
    {

      //unique:table,column,except,idColumn
      if($request->corporate == 1){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'company' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = new Collection;

            foreach($validator->errors()->toArray() as $errormsg)
            {
                $errors->push($errormsg[0]);
            }
            return redirect()->back()->withErrors($validator);
        }

        $user = new User;

        $user->fill($request->all());
        $user->password = $request->input('password');
        $user->api_token = str_random(60);
        $user->company_id = $request->company;
        if (!$user->save())
        {
            return redirect()->back()->withErrors("Unable to create user at this time");
        }
        else
        {
            return redirect()->route('home');
        }
      }

      else{
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            $errors = new Collection;

            foreach($validator->errors()->toArray() as $errormsg)
            {
                $errors->push($errormsg[0]);
            }
            return redirect()->back()->withErrors($validator);
        }

        $user = new User;

        $user->fill($request->all());
        $user->password = $request->input('password');
        $user->api_token = str_random(60);
        $user->company_id = 0;
        if (!$user->save())
        {
            return redirect()->back()->withErrors("Unable to create user at this time");
        }
        else
        {
            return redirect()->route('home');
        }
      }

    }

}
