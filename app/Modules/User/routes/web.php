<?php

Route::group(['module' => 'User', 'middleware' => ['web','auth'], 'namespace' => 'App\Modules\User\Controllers'], function() {

    Route::get('user/profile','UserController@profile');
    Route::post('user/profile/basic-info-save','UserController@basicInfoSave');
    Route::post('user/profile/edu-info-save','UserController@eduInfoSave');
    Route::post('user/profile/password-update','UserController@updatePassword');

});
