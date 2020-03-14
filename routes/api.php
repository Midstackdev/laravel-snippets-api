<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('login', 'SignInController');
    Route::post('logout', 'SignOutController');
    Route::get('me', 'MeController');
});

Route::group(['prefix' => 'snippets', 'namespace' => 'Snippets'], function () {
    Route::post('', 'SnippetController@store');
    Route::get('{snippet}', 'SnippetController@show');
});
