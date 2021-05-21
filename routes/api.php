<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function() {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/register', 'Api\V1\AuthController@register');
        Route::post('/login', 'Api\V1\AuthController@login');
        Route::post('/logout', 'Api\V1\AuthController@logout');
        Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
        Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
        Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
    });
    Route::get('/currencies', 'Api\V1\CurrenciesController@index');
    Route::get('/currencies/search/from', 'Api\V1\CurrenciesController@showFromCurrencyRate');
    Route::get('/currencies/search/to', 'Api\V1\CurrenciesController@showToCurrencyRate');
    Route::get('/currencies/history/{currency}', 'Api\V1\CurrenciesController@showCurrencyRateHistory');    
});