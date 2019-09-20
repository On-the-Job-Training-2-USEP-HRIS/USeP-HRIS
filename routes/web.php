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
// Route::get('/','PagesController@PDSForm');

Route::get('/PDSmenu','PagesController@PDSmenu');

Route::post('/PDSmenu','InsertController@addSection');

Route::get('/PDSField','PagesController@PDSField');

Route::post('/PDSField','InsertController@addFields');

Route::get('/PDSSubfield','PagesController@PDSSubfields');

Route::post('/PDSSubfield','InsertController@addSubfields');

Route::get('/Employee', 'PagesController@employee');

Route::get('/PDSForm','PagesController@PDSForm');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



