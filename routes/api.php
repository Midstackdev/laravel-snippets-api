<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('login', 'SignInController');
    Route::post('logout', 'SignOutController');
    Route::post('register', 'SignUpController');
    Route::get('me', 'MeController');
});

Route::group(['prefix' => 'snippets', 'namespace' => 'Snippets'], function () {
    Route::get('', 'SnippetController@index');
    Route::post('', 'SnippetController@store');
    Route::delete('{snippet}', 'SnippetController@destroy');
    Route::get('{snippet}', 'SnippetController@show');
    Route::patch('{snippet}', 'SnippetController@update');

    Route::patch('{snippet}/steps/{step}', 'StepController@update');
    Route::delete('{snippet}/steps/{step}', 'StepController@destroy');
    Route::post('{snippet}/steps', 'StepController@store');
});

Route::group(['prefix' => 'me', 'namespace' => 'Me'], function () {
    Route::get('snippets', 'SnippetController@index');
});

Route::group(['prefix' => 'users/{user}', 'namespace' => 'Users'], function () {
    Route::get('', 'UserController@show');
    Route::patch('', 'UserController@update');

    Route::get('snippets', 'SnippetController@index');
});

Route::group(['prefix' => 'keys', 'namespace' => 'Keys'], function () {
    Route::get('algolia', 'AlgoliaKeyController');
});
