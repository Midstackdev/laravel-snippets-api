<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('login', 'SignInController');
    Route::get('me', 'MeController');
});
