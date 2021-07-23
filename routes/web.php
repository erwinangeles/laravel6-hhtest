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

Route::get('user/profile', 'AuthController@profile')->name('user.profile');
