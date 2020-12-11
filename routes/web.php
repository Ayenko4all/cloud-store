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

//Route::get('/', function () {
//    return view('welcome');
//});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

use App\Http\Controllers\Front\ListingsController;

Route::namespace('Front')->group(function (){

    Route::get('/','IndexController@index')->name('front.index');

    Route::get('/category/{url}','ListingsController@index')->name('front.listings.index');

//    $catUrls = \App\Category::select(['url'])->where('status',1)->get()->pluck('url')->toArray();
//    //echo "<pre>"; print_r($catUrls); die;
//
//    foreach ($catUrls as $url){
//        Route::get('/home'.$url,'ListingsController@index')->name('front.listings.index');
//    }

    Route::get('/contact-us','ContactUsController@index')->name('front.contact.us');

});

