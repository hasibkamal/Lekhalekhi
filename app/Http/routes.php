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
    return view('layout.welcome');
});

Route::get('crud/create','CrudController@createForm');
Route::post('crud/store','CrudController@storeInformation');
Route::get('crud/list','CrudController@getList');
Route::get('crud/edit/{id}','CrudController@editInformation');
Route::post('crud/update/{id}','CrudController@updateInformation');
Route::get('crud/delete/{id}','CrudController@deleteInformation');
Route::get('layout','MyController@layout');
Route::get('dashboard','MyController@dashboard');
Route::get('home','MyController@home');
