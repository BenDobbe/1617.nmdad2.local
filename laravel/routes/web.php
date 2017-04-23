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

Route::group([
    'name' => 'verify',
    'as' => 'verify.'
], function () {
    Route::get('/verify', 'VerifyController@index')->name('index');
    Route::post('/verify', 'VerifyController@check')->name('check');
});
