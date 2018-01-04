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

Route::get('/', 'HomeController@numbers');
// Route::get('/faq', 'HomeController@faq');
// Route::get('/about', 'HomeController@about');
// Route::get('/privacy', 'HomeController@privacy');
// Route::get('/bug', 'HomeController@bug');
// Route::get('/list', 'HomeController@listListings')->name('listing.list');

// Route::get('/login', 'SocialAuthController@redirect')->name('login');
// Route::get('/callback', 'SocialAuthController@callback');
// Route::post('/logout', 'SocialAuthController@logout')->name('logout');

// Route::post('/contact/send-message', 'ContactController@fireMessage')->name('contact.fireMessage');
// Route::resource('listing', 'ListingController');
// Route::post('listing/book/{listing}', 'ListingController@book')->name('listing.book');

// Route::get('/storage/{path}', function($path) {
//     return response()->file(storage_path().'/app/'.$path);
// })->name('storage')->where('path','(.*)');