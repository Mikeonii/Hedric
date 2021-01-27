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


Route::get('/', 'PagesController@index');
Route::resource('transaction','TransactionsController');
Route::get('/items/delete/{id}','itemsController@destroy');
Route::resource('items','itemsController');
Route::get('/about', 'PagesController@about');
// ajax
Route::post('import','itemsController@import');
Route::post('export','itemsController@export');
Route::post('addTrans','TransactionsController@store');
Route::post('storeBatch','BatchTransactionsController@store');
Route::post('store','itemsController@store');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

