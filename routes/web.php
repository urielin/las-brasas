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

Route::get('/home', 'UsuariosController@index')->name('home');

Route::get('/usuarios', 'UsuariosController@index')->name('usuarios');

Route::get('/precio-camion', 'PrecioCamionController@index')->name('precio-camion');

Route::get('/tipo-cambio', 'TipoCambioController@index')->name('tipo-cambio');

Route::put('/actualizar-cambio', 'TipoCambioController@update')->name('updateCambio');

Route::get('/mostrar-cambio', 'TipoCambioController@show')->name('showCambio');

// Route::get('/gestion-camion', 'TUsuariosController@index')->name('gestion-camion');

Route::post('/actualizar-ofertas', 'PrecioCamionController@update')->name('actualizar-ofertas');
Route::get('/gestion-camion', 'GestionCamionController@index')->name('gestion-camion');

Route::get('/ver-camion', 'GestionCamionController@show')->name('showCamion');


Route::get('/obtener-camion', 'GestionCamionController@getcamion')->name('getCamion');

Route::get('/tabla-camion', 'GestionCamionController@gettablecamion')->name('gettableCamion');

Route::get('/select-clasificacion', 'GestionCamionController@getclasificacion')->name('getClasificacion');


Route::get('/test', 'GestionCamionController@test')->name('test');

// ---------------------

Route::get('/gestion-camion-r', 'GestionCamionController@indexr')->name('gestion-camion-r');

Route::get('/ver-camion-r', 'GestionCamionController@showr')->name('showCamion-r');
//
//
Route::get('/obtener-camion-r', 'GestionCamionController@getcamionr')->name('getCamion-r');
//
Route::get('/tabla-camion-r', 'GestionCamionController@gettablecamionr')->name('gettableCamion-r');
//
Route::get('/item-camion', 'GestionCamionController@getitem')->name('getitem');

// Route::get('/select-clasificacion', 'GestionCamionController@getclasificacion')->name('getClasificacion');
