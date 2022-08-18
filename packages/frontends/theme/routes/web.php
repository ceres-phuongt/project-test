<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Frontend\Theme\Http\Controllers', 'middleware' => ['web']], function () {
    Route::group(['as' => 'frontend.'], function () {
        Route::get('/', ['as' => 'homepage', 'uses' => 'ThemeController@index']);
    });
});
