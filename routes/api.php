<?php

use Illuminate\Http\Request;

Route::group(['namespace' => 'API', 'middleware' => ['cors']], function () {
//Before login calls
  Route::post('/signin',['as' => 'api.login', 'uses' => 'UserController@postSignIn']);
  Route::post('/register',['as' => 'api.register', 'uses' => 'UserController@createUser']);
  Route::get('/companies',['as' => 'api.companies', 'uses' => 'UserController@getCompanies']);

//Event Pages Calls
  Route::get('/upcoming/{user_id}',['as' => 'api.upcoming', 'uses' => 'EventController@getUpcomingEvents']);
  Route::get('/pastevents/{user_id}',['as' => 'api.past', 'uses' => 'EventController@getPastEvents']);



  Route::get('/user',['as' => 'api.getusers', 'uses' => 'UserController@getUsers']);
  Route::get('/getuser/{id}',['as' => 'api.getUser', 'uses' => 'UserController@getUserData']);




  Route::get('/myevent/{id}',['as' => 'api.myevent', 'uses' => 'EventController@getMyEvent']);

  Route::post('/setVolunteer',['as' => 'api.volunteer', 'uses' => 'EventController@postVolunteer']);
  Route::post('/setWithdraw',['as' => 'api.withdraw', 'uses' => 'EventController@postWithdraw']);

  Route::post('/undomarked',['as' => 'api.undomarked', 'uses' => 'EventController@undoMarking']);
  Route::post('/marked',['as' => 'api.markattendance', 'uses' => 'EventController@markAttendance']);
  Route::post('/blemark',['as' => 'api.blemark', 'uses' => 'EventController@bleMarkAttendance']);

  Route::post('/attendance',['as' => 'api.attendance', 'uses' => 'EventController@postAttendance']);
  Route::get('/secret/{id}',['as' => 'api.secret', 'uses' => 'EventController@getSecret']);
  Route::get('/present/{id}',['as' => 'api.secret', 'uses' => 'EventController@getPresent']);
  Route::get('/absent/{id}',['as' => 'api.secret', 'uses' => 'EventController@getAbsent']);
  Route::get('/getEventAttendance/{id}/{user}',['as' => 'api.eventattendance', 'uses' => 'EventController@getEventAttendance']);
});
