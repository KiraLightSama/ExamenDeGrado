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

Route::get('/ejercicio/create', 'EjercicioController@create')->name('ejercicio.create');
Route::post('/ejercicio/store', 'EjercicioController@store')->name('ejercicio.store');

Route::get('/objetivo/create', 'ObjetivoController@create')->name('objetivo.create');
Route::post('/objetivo/subir', 'ObjetivoController@subir')->name('objetivo.subir');
Route::post('/objetivo/bajar', 'ObjetivoController@bajar')->name('objetivo.bajar');
Route::post('/objetivo/mantener', 'ObjetivoController@mantener')->name('objetivo.mantener');

Route::get('/preferencia/create', 'PreferenciaController@create')->name('preferencia.create');
Route::post('/preferencia/store', 'PreferenciaController@store')->name('preferencia.store');