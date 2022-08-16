<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Backend\Car\Http\Controllers', 'middleware' => ['web']], function () {

    Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'car', 'as' => 'car.'], function () {
            Route::resource('', 'CarController')->parameters(['' => 'car']);

            Route::delete('items/destroy', [
            'as'         => 'deletes',
            'uses'       => 'CarController@deletes'
            ]);
        });
    });
});
