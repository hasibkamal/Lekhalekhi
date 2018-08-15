<?php

Route::group(['module' => 'Signup', 'middleware' => ['api'], 'namespace' => 'App\Modules\Signup\Controllers'], function() {

    Route::resource('Signup', 'SignupController');

});
