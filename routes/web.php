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


Route::group(['middleware' => ['role:admin']], function() {

    Route::get('/myInfo', 'AdminController@Info');

    Route::get('/admin/user/register', 'Access\UsersController@showRegistrationForm');

    Route::post('/admin/user/register', 'Access\UsersController@register');

    //Route::get('/admin/user/list', 'Access\UsersController@index');

    Route::get('/admin/user/index', 'Access\UsersController@index');

    Route::get('/admin/user/{user}','Access\UsersController@detail');

    Route::post('/admin/function/register', 'Access\FunctionsController@register');

    Route::get('/admin/function/list', 'Access\FunctionsController@index');

    Route::get('/admin/function/{function}','Access\FunctionsController@detail');

    Route::get('/dashboard', 'DashBoardController@index');

//    Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
});



Route::get('/api2/sidebar', 'DashBoardController@sidebar');

Route::get('/api2/user/search', 'Access\UsersController@getData');

//vSzSAUk4TLvPX2FPDeem8bSrHdINhrqqyXtErFar