<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::resource('ads','AdController');

Route::get('/home', 'HomeController@index');

//Route::get('ads/{ad}',function (\App\Ad $ad){ //implicit bindind
//    return $ad;
//});



//Route::group(['middleware' => ['web']], function () {
//    Route::resource('ads','AdController');
//});