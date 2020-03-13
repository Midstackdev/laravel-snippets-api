<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('login', 'SignInController');
    Route::post('logout', 'SignOutController');
    Route::get('me', 'MeController');
});
