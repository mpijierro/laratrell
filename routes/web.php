<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', ['as' => 'dashboard', 'uses' => "DashboardController@dashboard"]);

Route::get('auth/trello', ['as' => 'authWithTrello', 'uses' => 'Auth\AuthController@redirectToProvider']);
Route::get('auth/trello/callback', ['as' => 'authCallback', 'uses' => 'Auth\AuthController@handleProviderCallback']);
