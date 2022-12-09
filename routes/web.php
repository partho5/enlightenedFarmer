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

Route::get('/', function () {
    return view('index');
});

Route::get('farmers/enlist', 'FarmerController@showRegForm');
Route::get('farmers/all', 'FarmerController@fetchAllFarmers');
Route::resource('farmers', 'FarmerController');



Route::get('admin/panel', function (){
    return redirect('/home');
});
Route::get('/admin/add_wdata', 'AdminController@Show_AddWeatherDataPage');
Route::get('/admin/test/sms', function(){
    return view('test_sms');
});
Route::post('/admin/test/sms', 'AdminController@sendTestSms');

Route::get('/admin/send/sms', 'AdminController@show_sendSmsPage');
Route::post('/admin/send/sms', 'AdminController@sendSmsToFarmersDatewise');

Route::resource('admin', 'AdminController');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
