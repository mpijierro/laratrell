<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', ['as' => 'home', 'uses' => "HomeController@index"]);

Route::get('auth/trello', ['as' => 'authWithTrello', 'uses' => 'AuthController@redirectToProvider']);
Route::get('auth/trello/callback', ['as' => 'authCallback', 'uses' => 'AuthController@handleProviderCallback']);

Route::get('dashboard', ['as' => 'dashboard', 'uses' => "DashboardController@dashboard"]);

Route::group(['middleware' => 'auth'], function () {

    Route::get('user-list', ['as' => 'userList', 'uses' => "UserListController@index"]);

});

