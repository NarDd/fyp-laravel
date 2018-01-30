<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Please follow naming convention


// Authenticated Users
// Auth::routes();
// Route::get('/', 'HomeController@index')->name('home');


// Admin Pages
Route::get('/events/create',['as' => 'admin.event.create', 'uses' => 'Admin\EventController@getCreateEvent']);
Route::post('/events/create',['as' => 'admin.event.create.post','uses' => 'Admin\EventController@postCreateEvent']);
Route::get('/skills',['as' => 'admin.skills.get','uses' => 'Admin\SkillsController@getSkills']);
Route::post('/skills',['as' => 'admin.skills.post','uses' => 'Admin\SkillsController@postSkills']);
Route::get('/createskill',['as' => 'admin.create.skill.get','uses' => 'Admin\SkillsController@getCreateSkills']);
Route::post('/createskill',['as' => 'admin.create.skill.post','uses' => 'Admin\SkillsController@postCreateSkills']);

// Route::get('/events/create',['as' => 'admin.event.create.get','uses' => 'ImageController@eventImgUpload']);
// Route::post('/events/create',['as' => 'admin.event.create.post','uses' => 'Admin\ImageController@eventImgUploadPost']);

Route::get('/events/view/all',['as' => 'admin.event.viewall', 'uses' => 'Admin\EventController@getAllEvent']);
Route::get('/events/edit/{id}',['as' => 'admin.event.edit', 'uses' => 'Admin\EventController@getEditEvent']);
Route::post('/events/edit/{id}',['as' => 'admin.event.edit.post','uses' => 'Admin\EventController@postUpdateEvent']);

Route::get('/manage/users',['as' => 'admin.manage.userlist','uses' => 'Admin\UserController@getUserList']);
Route::post('/manage/users',['as' => 'admin.user.approval','uses' => 'Admin\UserController@postUserList']);

Route::get('/manage/admin',['as' => 'admin.manage.adminlist','uses' => 'Admin\UserController@getAdminList']);
Route::post('/manage/admin',['as' => 'admin.manage.adminapprove','uses' => 'Admin\UserController@postAdminList']);

Route::get('/manage/users/{id}',['as' => 'admin.manage.user','uses' => 'Admin\UserController@getUser']);
// Route::post('/manage/users/{id}',['as' => 'admin.user.approval','uses' => 'Admin\UserController@userApproval']);

Route::get('/user/adminstatus/{id}',['as' => 'admin.user.setstatus', 'uses' => 'Admin\UserController@getSetStatus']);
// Accessible by all
Route::get('/',['as' => 'home','uses' => 'HomeController@getHome']);
Route::get('/register',['as' => 'register','uses' => 'Auth\AuthController@getRegister']);
Route::post('/register',['as' => 'register.post','uses' => 'Auth\AuthController@postRegister']);
Route::get('/upcomingevents',['as' => 'upcoming.events','uses' => 'EventController@getUpcomingEvent']);
Route::get('/pastevents',['as' => 'past.events','uses' => 'EventController@getPastEvent']);
Route::get('/event/{id}/{past}',['as' => 'event.view', 'uses' => 'EventController@getEvent']);
Route::post('/event/volunteer',['as' => 'event.volunteers','uses' => 'EventController@postVolunteer']);
// Route::get('/event/{id}/volunteer/{user}',['as' => 'event.volunteer','uses' => 'EventController@getVolunteer']);
// Route::get('/event/{id}/volunteer/{user}/withdraw',['as' => 'event.volunteer.withdraw','uses' => 'EventController@getVolunteerWithdraw']);
Route::get('/profile',['as' => 'profile.view', 'uses' => 'ProfileController@getProfile']);
Route::post('/profile/update',['as' => 'profile.update.post', 'uses' => 'ProfileController@postUpdateProfile']);
Route::get('/profile/update',['as' => 'profile.update.get', 'uses' => 'ProfileController@getUpdateProfile']);

Route::post('/profile/update/skill',['as' => 'profile.update.skill.post', 'uses' => 'ProfileController@postUpdateSkill']);
Route::get('/profile/update/skill',['as' => 'profile.update.skill.get', 'uses' => 'ProfileController@getUpdateSkill']);
// Accessible by Volunteers

// Login/Logout
Route::post('/login',['as' => 'login.post','uses' => 'Auth\AuthController@postLogin']);
Route::post('/logout',['as' => 'logout.post','uses' => 'Auth\AuthController@postLogout']);
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');
