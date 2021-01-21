<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function(){
    Route::get('/', 'App\Http\Controllers\Admin\DashboardController@getDashboard')->name('dashboard');

    // Users
    Route::get('/users/{status}', 'App\Http\Controllers\Admin\UserController@index')->name('users_list');
    Route::get('/user/{id}/edit', 'App\Http\Controllers\Admin\UserController@edit')->name('users_edit');
    Route::get('/user/{id}/banned', 'App\Http\Controllers\Admin\UserController@banUser')->name('users_ban');
    Route::get('/user/{id}/active', 'App\Http\Controllers\Admin\UserController@activeUser')->name('users_active');

    // Products
    Route::get('/products', 'App\Http\Controllers\Admin\ProductController@index')->name('products_list');
    Route::get('/products/add', 'App\Http\Controllers\Admin\ProductController@create')->name('products_add');
    Route::post('/products/store', 'App\Http\Controllers\Admin\ProductController@store')->name('products_add');
    Route::get('/products/edit/{id}', 'App\Http\Controllers\Admin\ProductController@edit')->name('products_edit');
    Route::put('/products/update/{id}', 'App\Http\Controllers\Admin\ProductController@update')->name('products_edit');
    Route::get('/products/delete/{id}', 'App\Http\Controllers\Admin\ProductController@destroy')->name('products_delete');
        // Gallery of products
        Route::post('/product/{id}/gallery/add', 'App\Http\Controllers\Admin\ProductController@galleryStore')->name('product_gallery_add');
        Route::get('/product/{product_id}/gallery/{image_id}/delete', 'App\Http\Controllers\Admin\ProductController@deleteImage')->name('products_gallery_delete');

    //Categories
    Route::get('/categories', 'App\Http\Controllers\Admin\CategoryController@index')->name('category_list');
    Route::get('/categories/add', 'App\Http\Controllers\Admin\CategoryController@create')->name('category_add');
    Route::post('/categories/store', 'App\Http\Controllers\Admin\CategoryController@store')->name('category_add');
    Route::get('/categories/edit/{id}', 'App\Http\Controllers\Admin\CategoryController@edit')->name('category_edit');
    Route::put('/categories/update/{id}', 'App\Http\Controllers\Admin\CategoryController@update')->name('category_edit');
    Route::get('/categories/delete/{id}', 'App\Http\Controllers\Admin\CategoryController@destroy')->name('category_delete');
});
