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
Route::post('/actualizar-ofertas', 'PrecioCamionController@update')->name('actualizar-ofertas');
Route::get('/gestion-camion', 'GestionCamionController@index')->name('gestion-camion');
Route::get('/ver-camion', 'GestionCamionController@show')->name('showCamion');
Route::get('/obtener-camion', 'GestionCamionController@getcamion')->name('getCamion');
Route::get('/tabla-camion', 'GestionCamionController@gettablecamion')->name('gettableCamion');

Route::get('/select-clasificacion', 'GestionCamionController@getclasificacion')->name('getClasificacion');
Route::get('/test', 'GestionCamionController@test')->name('test');
Route::get('/gestion-camion-r', 'GestionCamionController@indexr')->name('gestion-camion-r');
Route::get('/ver-camion-r', 'GestionCamionController@showr')->name('showCamion-r');
Route::get('/obtener-camion-r', 'GestionCamionController@getcamionr')->name('getCamion-r');
Route::get('/tabla-camion-r', 'GestionCamionController@gettablecamionr')->name('gettableCamion-r');
Route::post('/actualizar-camion', 'GestionCamionController@updateitem')->name('updateitem');


Route::get('/switch-item', 'GestionCamionController@switchitem')->name('switchitem');
// Route::get('/select-clasificacion', 'GestionCamionController@getclasificacion')->name('getClasificacion');



//JULIO
Route::get('/productos', 'ProductController@index')->name('product.index');
Route::get('/productos/filter', 'ProductController@filter')->name('product.filter');
Route::post('/productos/create', 'ProductController@create')->name('product.create');
Route::post('/productos/update-one', 'ProductController@updateSon')->name('product.update');
Route::get('/productos/clasificacion/list', 'ProductController@listClasificacion')->name('product.clasificacion.list');
Route::get('/productos/unidades/list', 'ProductController@listUnidades')->name('product.unidades.list');
Route::get('/productos/catalogo', 'ProductController@catalogo')->name('product.catalogo');
Route::get('/productos/findOne/', 'ProductController@findOne')->name('product.one');
Route::get('/productos/find-all-son/{id}', 'ProductController@findAllSon')->name('product.findAll');
Route::get('/clasificacion/list', 'ProductController@clasificacion')->name('product.clasificacion');
Route::get('/clasificacion/list2', 'ProductController@clasificacion2')->name('product.clasificacion2');
Route::get('/productos/nutricionals', 'ProductController@nutricionals')->name('product.nutricionals');
Route::post('/products/nutricionals/update', 'ProductController@updateNutricional')->name('product.updateNutricional');
Route::post('/productos/terminado/update', 'ProductController@updateProduct')->name('product.updateProduct');
//JULIO
