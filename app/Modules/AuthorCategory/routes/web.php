<?php

Route::group(['module' => 'AuthorCategory', 'middleware' => ['web','auth'], 'namespace' => 'App\Modules\AuthorCategory\Controllers'], function() {

    Route::get('/author-category/list','AuthorCategoryController@categoryList');
    Route::post('/author-category/get-list','AuthorCategoryController@getCategoryList');

    Route::get('/author-category/create','AuthorCategoryController@categoryCreate');

    Route::post('/author-category/store','AuthorCategoryController@categoryStore');
    Route::post('/author-category/store/{id}','AuthorCategoryController@categoryStore');
    Route::get('/author-category/delete/{id}','AuthorCategoryController@categoryDelete');
    Route::get('/author-category/edit/{id}','AuthorCategoryController@categoryEdit');
    Route::get('/author-category/open/{id}','AuthorCategoryController@categoryOpen');

});
