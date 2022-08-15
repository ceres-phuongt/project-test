<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Backend\User\Http\Controllers', 'middleware' => ['web']], function () {

    Route::group(['prefix' => 'auth', 'as' => 'auths.'], function () {
        Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@create']);
        Route::post('login', ['as' => 'store', 'uses' => 'Auth\LoginController@store']);
        Route::delete('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@destroy']);
    });

    Route::group(['prefix' => 'admin.', 'middleware' => 'auth'], function () {
        Route::group(['prefix' => 'user', 'as' => 'users.'], function () {
            Route::resource('', 'UserController')->parameters(['' => 'user']);

            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'UserController@deletes'
            ]);
        });
    });
});
