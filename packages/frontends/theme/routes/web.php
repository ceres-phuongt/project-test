<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Frontend\Theme\Http\Controllers', 'middleware' => ['web']], function () {
    Route::group(['as' => 'frontend.'], function () {
        Route::get('/', ['as' => 'homepage', 'uses' => 'ThemeController@index']);
        Route::get('car/detail/{id}', ['as' => 'product-detail', 'uses' => 'ThemeController@show']);
        Route::get('cart', ['as' => 'cart', 'uses' => 'CartController@cart']);
        Route::get('loadAjaxCart', ['as' => 'loadAjaxCart', 'uses' => 'CartController@loadAjaxCart']);
        Route::post('addToCart', ['as' => 'addToCart', 'uses' => 'CartController@addToCart']);
        Route::post('updateCart', ['as' => 'updateCart', 'uses' => 'CartController@updateCart']);
        Route::post('removeFromCart', ['as' => 'removeFromCart', 'uses' => 'CartController@removeFromCart']);
        Route::get('login', ['as' => 'login', 'uses' => 'LoginController@showLoginForm']);
    });
});
