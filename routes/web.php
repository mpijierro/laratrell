<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', ['as' => 'dashboard', 'uses' => "DashboardController@dashboard"]);

Route::get('auth/trello', 'Auth\AuthController@redirectToProvider');
Route::get('auth/trello/callback', 'Auth\AuthController@handleProviderCallback');