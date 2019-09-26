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
//Default ip address
Route::get('/','PagesController@home');

//PDS Menu
Route::get('/PDSmenu','PagesController@PDSmenu');
Route::post('/PDSmenu','InsertController@addSection');

//PDS Field
Route::get('/PDSField','PagesController@PDSField');
Route::post('/PDSField','InsertController@addFields');

//PDS Subfield
Route::get('/PDSSubfield','PagesController@PDSSubfields');
Route::post('/PDSSubfield','InsertController@addSubfields');

//Employee
Route::get('/Employee', 'PagesController@employee');

//PDS Form
Route::get('/PDSForm','PagesController@PDSForm');
Route::post('/PDSForm','InsertController@addForm');

//Employment
Route::get('/Employment','PagesController@Employment');
Route::post('/Employment','InsertController@addEmployee');

//Authentication
Auth::routes();

//Home page, authentication route
Route::get('/home', 'HomeController@index')->name('home');



