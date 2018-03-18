<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if(Auth::check()){
        $adminCheck = User::where('id', Auth::id())->get()->first()->isadmin;
        if($adminCheck == 1){
            return $next($request);
        }
      }

      return redirect('/');
    }
}
