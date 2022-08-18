<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Backend\Dashboard\Http\Controllers', 'middleware' => ['web']], function () {

    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'checkAdminLogin']], function () {
        Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
            Route::resource('', 'DashboardController')->parameters(['' => 'dashboard']);
        });
    });
});
