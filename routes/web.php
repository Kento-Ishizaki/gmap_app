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

Route::get('/', function() {
    return view('top');
});

Route::resource('users', 'UserController');
Route::resource('map', 'MapController');
Route::post('/map/{map}/comments', 'CommentController@store')->middleware('auth')->name('comments.store');
Auth::routes();
Route::post('/map/{map}/like','LikeController@like')->middleware('auth')->name('likes.like');
Route::delete('/map/{map}/unlike','LikeController@unlike')->middleware('auth')->name('likes.unlike');

Route::get('/home', 'HomeController@index')->name('home');
