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

Route::get('/', 'HomeController@index');
Route::get('/login', 'SocialAuthController@redirect')->name('login');
Route::get('/callback', 'SocialAuthController@callback');
Route::post('/logout', 'SocialAuthController@logout')->name('logout');

Route::resource('listing', 'ListingController');
Route::post('listing/book/{listing}', 'ListingController@book')->name('listing.book');

Route::resource('contact', 'ContactController');

Route::get('/storage/{path}', function($path) {
    return response()->file(storage_path().'/app/'.$path);
})->name('storage')->where('path','(.*)');