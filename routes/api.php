<?php

use Illuminate\Http\Request;

Route::group(['namespace' => 'API', 'middleware' => ['cors']], function () {
  Route::post('/signin',['as' => 'api.login', 'uses' => 'UserController@postSignIn']);
  Route::get('/user',['as' => 'api.getusers', 'uses' => 'UserController@getUsers']);
  Route::get('/getuser/{id}',['as' => 'api.getUser', 'uses' => 'UserController@getUserData']);
  Route::post('/register',['as' => 'api.register', 'uses' => 'UserController@createUser']);

  Route::get('/upcoming',['as' => 'api.upcoming', 'uses' => 'EventController@getUpcoming']);
  Route::get('/pastevents',['as' => 'api.past', 'uses' => 'EventController@getPastEvent']);
  Route::get('/myevent/{id}',['as' => 'api.myevent', 'uses' => 'EventController@getMyEvent']);

  Route::post('/setVolunter',['as' => 'api.volunteer', 'uses' => 'EventController@postVolunteer']);
  Route::post('/setWithdraw',['as' => 'api.withdraw', 'uses' => 'EventController@postWithdraw']);

  Route::post('/attendance',['as' => 'api.attendance', 'uses' => 'EventController@postAttendance']);
  Route::get('/secret/{id}',['as' => 'api.secret', 'uses' => 'EventController@getSecret']);
  Route::get('/present/{id}',['as' => 'api.secret', 'uses' => 'EventController@getPresent']);
  Route::get('/absent/{id}',['as' => 'api.secret', 'uses' => 'EventController@getAbsent']);
  Route::get('/getEventAttendance/{id}/{user}',['as' => 'api.eventattendance', 'uses' => 'EventController@getEventAttendance']);
});
