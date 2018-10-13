<?php

Route::group(['module' => 'Author', 'middleware' => ['web','auth'], 'namespace' => 'App\Modules\Author\Controllers'], function() {

    Route::get('author/list','AuthorController@authorList');
    Route::post('author/get-list','AuthorController@getAuthorList');
    Route::get('author/create','AuthorController@authorCreate');
    Route::post('author/store','AuthorController@authorStore');

});
