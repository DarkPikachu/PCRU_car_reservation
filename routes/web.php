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

Route::get('oauth', function () {
    return view('oauth');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/landing', 'LandingController@index')->name('landing');

Route::get('/task/add', 'LandingController@index')->name('addtask');

Route::get('/task/detail', 'LandingController@index')->name('taskdetail');

Route::get('/task/view', 'LandingController@index')->name('view');