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
    return redirect()->route('login');
});

Route::fallback(function (){
    return redirect()->route('menu.index');
});

Auth::routes();

Route::get('/ejercicio/create', 'EjercicioController@create')->name('ejercicio.create')->middleware('auth');
Route::post('/ejercicio/store', 'EjercicioController@store')->name('ejercicio.store')->middleware('auth');

Route::get('/objetivo/create', 'ObjetivoController@create')->name('objetivo.create')->middleware('auth');
Route::post('/objetivo/subir', 'ObjetivoController@subir')->name('objetivo.subir')->middleware('auth');
Route::post('/objetivo/bajar', 'ObjetivoController@bajar')->name('objetivo.bajar')->middleware('auth');
Route::post('/objetivo/mantener', 'ObjetivoController@mantener')->name('objetivo.mantener')->middleware('auth');

Route::get('/alimento/create', 'AlimentoController@create')->name('alimento.create')->middleware('auth');
Route::post('/alimento/store', 'AlimentoController@store')->name('alimento.store')->middleware('auth');
Route::get('/alimento/edit', 'AlimentoController@edit')->name('alimento.edit')->middleware('auth');
Route::post('/alimento/update', 'AlimentoController@update')->name('alimento.update')->middleware('auth');

Route::get('/menu', 'MenuController@index')->name('menu.index')->middleware('auth');

Route::post('/seguimiento/create', 'SeguimientoController@create')->name('seguimiento.create')->middleware('auth');
Route::post('/marcar', 'SeguimientoController@marcar')->name('seguimiento.marcar')->middleware('auth');

Route::get('/perfil', 'UserController@index')->name('user.index')->middleware('auth');
