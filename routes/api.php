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
    Route::patch('{snippet}', 'SnippetController@update');

    Route::patch('{snippet}/steps/{step}', 'StepController@update');
    Route::delete('{snippet}/steps/{step}', 'StepController@destroy');
    Route::post('{snippet}/steps', 'StepController@store');
});
