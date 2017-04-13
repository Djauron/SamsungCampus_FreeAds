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

Route::get('/', 'HomeController@index');

Auth::routes();


Route::resource('users', 'UsersController');


Route::resource('annonces', 'AnnoncesController');
Route::post('/annonces', 'AnnoncesController@index')->name('annonces.index');

Route::get('/annonces/{id}/destroy','AnnoncesController@destroy');
