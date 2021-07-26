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
Route::get('login', 'AuthController@login')->name('login');
Route::post('login', 'AuthController@postLogin')->name('auth.postLogin');

Route::get('register', 'AuthController@register')->name('register');
Route::post('register', 'AuthController@postRegister')->name('auth.postRegister');
Route::post('logout', 'AuthController@logout')->name('logout');

Route::get('user/profile', 'UserController@profile')->name('user.profile');
Route::post('user/update', 'UserController@update')->name('user.update');

Route::post('user/apiKey/create', 'UserController@generateAPIKey')->name('user.generateAPIKey');