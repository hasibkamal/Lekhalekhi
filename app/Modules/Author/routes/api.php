<?php

Route::group(['module' => 'Author', 'middleware' => ['api'], 'namespace' => 'App\Modules\Author\Controllers'], function() {

    Route::resource('Author', 'AuthorController');

});
