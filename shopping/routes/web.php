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

Route::get('/', 'IndexController@index');
Route::post('/', 'IndexController@cart');
Route::get('/cartitem', 'CartController@index');
Route::put('/cartitem', 'CartController@update');
Route::delete('/cartitem', 'CartController@destroy');
Route::get('/buy', 'CartController@add');
Route::post('/buy', 'CartController@buy');
Route::post('/confirm', 'CartController@confirm');
