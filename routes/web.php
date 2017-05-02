<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('lobby', 'PagesController@lobby')->middleware('auth')->name('lobby');
Route::get('history', 'PagesController@history')->name('history');

Route::get('game/{game}', 'TyponautController@index')->middleware('game.player');

Route::group(['prefix' => 'api'], function () {

    Route::get('games', 'GamesController@index');
    Route::post('games', 'GamesController@store');
    Route::get('games/{game}', 'GamesController@show');
    Route::post('games/{game}/start', 'TyponautController@startGame');
    Route::post('games/{game}/finish', 'TyponautController@finishGame');
});

Route::get('users/{user_id}/profile', 'ProfilesController@index');
