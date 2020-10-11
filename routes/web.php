<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'MoviesController@index')->name('movies.index');
Route::get('/movies/{movie}', 'MoviesController@show')->name('movies.show');

Route::get('/actors', 'ActorsController@index')->name('actors.index');
Route::get('/actors/page/{page}', 'ActorsController@index')->where('page', '\b(0*(?:[1-9][0-9]?|100))\b');
Route::get('/actors/{actor}', 'ActorsController@show')->name('actors.show');

Route::get('/tv', 'TvSeriesController@index')->name('tv.index');
Route::get('/tv/{id}', 'TvSeriesController@show')->name('tv.show');