<?php

Route::group(['module' => 'User', 'middleware' => ['web','auth'], 'namespace' => 'App\Modules\User\Controllers'], function() {

    Route::get('user/profile','UserController@profile');

});
