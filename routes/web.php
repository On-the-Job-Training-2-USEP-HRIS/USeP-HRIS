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

Route::get('/','PagesController@home');

Route::get('/PDSmenu','PagesController@PDSmenu');

Route::post('/PDSmenu','PagesController@addSection');

Route::get('/PDSField','PagesController@PDSField');

Route::post('/PDSField','PagesController@addFields');

Route::get('/PDSSubfield','PagesController@PDSSubfields');

Route::post('/PDSSubfield','PagesController@addSubfields');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



