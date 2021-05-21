<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/{vue?}', 'DashboardController@index')->where('vue', '[\/\w\.-]*');
// Route::post('/login', 'Auth\LoginController@login')->name('login');
// Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
// Auth::routes();

