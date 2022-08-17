<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Backend\Car\Http\Controllers', 'middleware' => ['web']], function () {

    Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'car', 'as' => 'car.'], function () {
            Route::resource('', 'CarController')->parameters(['' => 'car']);
        });

        Route::group(['prefix' => 'tag', 'as' => 'tag.'], function () {
            Route::resource('', 'TagController')->parameters(['' => 'tag']);
        });
    });
});
