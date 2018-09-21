<?php

Route::group(['module' => 'AuthorCategory', 'middleware' => ['api'], 'namespace' => 'App\Modules\AuthorCategory\Controllers'], function() {

    Route::resource('AuthorCategory', 'AuthorCategoryController');

});
