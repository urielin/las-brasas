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

Route::get('/usuarios', 'UsuariosController@index')->name('usuarios');

Route::get('/precio-camion', 'PrecioCamionController@index')->name('precio-camion');

Route::get('/tipo-cambio', 'TipoCambioController@index')->name('tipo-cambio');
Route::post('/subir-cambio', 'TipoCambioController@store')->name('nuevo-cambio');

Route::get('/gestion-camion', 'TUsuariosController@index')->name('gestion-camion');
