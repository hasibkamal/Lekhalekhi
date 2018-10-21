<?php

Route::group(['module' => 'Author', 'middleware' => ['web','auth'], 'namespace' => 'App\Modules\Author\Controllers'], function() {

    Route::get('author/list','AuthorController@authorList');
    Route::post('author/get-list','AuthorController@getAuthorList');
    Route::get('author/create','AuthorController@authorCreate');
    Route::post('author/store','AuthorController@authorStore');
    Route::post('author/store/{id}','AuthorController@authorStore');
    Route::get('author/delete/{id}','AuthorController@authorDelete');
    Route::get('author/edit/{id}','AuthorController@authorEdit');
    Route::get('author/open/{id}','AuthorController@authorOpen');

});
