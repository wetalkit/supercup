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
    return view('home');
});

Route::get('/login', 'SocialAuthController@redirect')->name('login');
Route::get('/callback', 'SocialAuthController@callback');
Route::post('/logout', 'SocialAuthController@logout')->name('logout');

Route::group(['prefix' => 'book', 'middleware' => 'auth'], function (){
    Route::get('/', function (){
        return "Here comes the book view";
    });
});
