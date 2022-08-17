<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Backend\Car\Http\Controllers', 'middleware' => ['web']], function () {

    Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'car', 'as' => 'car.'], function () {
            Route::resource('', 'CarController')->parameters(['' => 'car']);
        });

        Route::group(['prefix' => 'tag', 'as' => 'tag.'], function () {
            Route::get('all', ['as' => 'all', 'uses' => 'TagController@getAllTags']);
            Route::resource('', 'TagController')->parameters(['' => 'tag']);
        });

        Route::group(['prefix' => 'engine-size', 'as' => 'engine-size.'], function () {
            Route::resource('', 'EngineSizeController')->parameters(['' => 'engine-size']);
        });

        Route::group(['prefix' => 'make', 'as' => 'make.'], function () {
            Route::resource('', 'MakeController')->parameters(['' => 'make']);
        });
    });
});
