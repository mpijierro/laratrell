<?php

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::get('auth', ['as' => 'authWithTrello', 'uses' => 'AuthController@redirectToProvider']);
Route::get('auth/callback', ['as' => 'authCallback', 'uses' => 'AuthController@handleProviderCallback']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@dashboard']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);

    Route::get('user-list', ['as' => 'userList', 'uses' => 'UserListController@index']);
});
