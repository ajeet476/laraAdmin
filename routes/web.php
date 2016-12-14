<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//outside register not allowed
//Route::get('/register',function (){
//   abort(404);
//});

Route::get('/home', 'HomeController@index');

Route::get('/adminLogin', 'AdminController@login');
Route::get('/callback', 'AdminController@callback');
Route::get('/myInfo', 'AdminController@Info');


Route::get('/admin/user/list', 'Access\UsersController@index');

Route::get('/admin/user/{user}','Access\UsersController@detail');

Route::get('/admin/user/register', 'Access\UserController@showRegistrationForm');

Route::post('/admin/user/register', 'Access\UserController@register');


//vSzSAUk4TLvPX2FPDeem8bSrHdINhrqqyXtErFar