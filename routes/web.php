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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/contact', 'ContactController@create')->name('contact')->middleware("checkage");
    Route::get('/contact/edit/{id}', 'ContactController@edit')->name('contact-edit')->where('id','^[0-9]+$');
    Route::post('/contact/save', 'ContactController@store')->name('contact_save');
    Route::put('/contact/update/{id}', 'ContactController@update')->name('contact_update')->where('id','^[0-9]+$');
    Route::delete('/contact/delete/{id}', 'ContactController@destroy')->name('contact_delete')->where('id','^[0-9]+$');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
