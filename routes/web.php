<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front.template ');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/getBees', 'BeeController@getBees');

Route::get('/getMonths', 'MonthController@getMonths');

Route::post('/createBee', 'BeeController@createBee');
