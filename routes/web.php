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

Route::group(['prefix' => 'book', 'middleware' => 'auth'], function (){
    Route::get('/', function (){
        return "Here comes the book view";
    });
});

Route::resource('listing', 'ListingController', ['names' => [ 
    'create' => 'listing.create',
    'show' => 'listing.show',
    'index' => 'listing.index'
]]);

Route::resource('contact', 'ContactController', ['names' => [
    'create' => 'contact.create',
    'show' => 'contact.show',
    'store' => 'contact.store',

]]);

Route::get('/storage/{path}', function($path) {
    return response()->file(storage_path().'/app/'.$path);
})->name('storage')->where('path','(.*)');