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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('userlist', 'MessageController@userlist')->name('userlist');
Route::get('usermessage/{id}', 'MessageController@usermessage')->name('usermessage');
Route::post('sendmessage', 'MessageController@sendmessage')->name('sendmessage');
Route::get('deletesinglemessage/{id}', 'MessageController@deletesinglemessage')->name('deletesinglemessage');
Route::get('deleteallmessage/{id}', 'MessageController@deleteallmessage')->name('deleteallmessage');


