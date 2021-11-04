<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('/auth/register', 'AuthController@register');

Route::post('/auth/login', 'AuthController@login');

Route::group(['middleware' => ['auth:sanctum']], function () {
   
    Route::get('/logout', 'AuthController@logout');
    Route::post('search','SearchController@search');
    Route::post('/get-playlists-by-album','SearchController@getPlaylistsByAlbum');
    Route::post('/get-by-artists','SearchController@getByArtist');
    Route::get('/get-playlists-by-track/{id}','SearchController@getPlaylistByTrackId');
    Route::get('/get-playlists/{id}','SearchController@getPlaylistById');
    Route::resource('play-list','PlayListsController');
    Route::resource('song','SongController');
    Route::resource('event','EventController');
    Route::get('/home','HomeController@index');
});


