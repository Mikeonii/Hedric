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


// Route::get('/', 'PagesController@index');
Route::resource('transaction','TransactionsController');
Route::get('/items/delete/{id}','itemsController@destroy');
// Route::resource('items','itemsController');
// Route::get('/about', 'PagesController@about');
// ajax
Route::post('/suppliers','PagesController@suppliers');

Route::post('addTrans','TransactionsController@store');
Route::post('storeBatch','BatchTransactionsController@store');
Route::post('add_new_item','itemsController@store');
// add new supplier
Route::post('add_supplier','SupplierController@store');
// add to transaction
Route::post('add_to_transaction','TransactionsController@store');
// add stocks to item
Route::post('add_stocks','itemsController@add_stocks');
// export stocks
Route::post('export','itemsController@export');
// inventory report
Route::get('inventory','PagesController@inventory');
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
// excel export
Route::get('/items_export','itemsController@export_excel');
// excel export view
// Route::get('/excel_export','itemsController@export_excel');
// individual item view
Route::get('/item/{item_id}','PagesController@show_item');

