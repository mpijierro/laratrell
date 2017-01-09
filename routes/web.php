<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', ['as' => 'dashboard', 'uses' => "DashboardController@dashboard"]);