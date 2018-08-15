<?php

Route::group(['module' => 'Signup', 'middleware' => ['web'], 'namespace' => 'App\Modules\Signup\Controllers'], function() {

    Route::resource('Signup', 'SignupController');

});
