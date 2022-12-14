<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Backend\User\Http\Controllers', 'middleware' => ['web']], function () {

    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', ['as' => 'create', 'uses' => 'Auth\LoginController@create'])->middleware('guest');
        Route::post('login', ['as' => 'store', 'uses' => 'Auth\LoginController@store'])->middleware('guest');
        Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logOut'])->middleware('auth');
    });

    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'checkAdminLogin']], function () {
        Route::group(['prefix' => 'user', 'as' => 'users.'], function () {
            Route::resource('', 'UserController')->parameters(['' => 'user']);

            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'UserController@deletes'
            ]);
        });
    });
});
