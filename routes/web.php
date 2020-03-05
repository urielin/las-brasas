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

Route::group(['middleware'=> ['guest']],function(){
  Route::get('/','Auth\LoginController@showLoginForm');
  Route::get('/logout','Auth\LoginController@showLoginForm')->name('logout');
  Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'Auth\LoginController@login');
});

Route::group(['middleware' => 'auth_custom'], function () {

  Route::get('/', 'HomeController@index');

  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/usuarios', 'UsuariosController@index')->name('usuarios');
  Route::get('/precio-camion', 'PrecioCamionController@index')->name('precio-camion');
  Route::post('/show-precio-camion', 'PrecioCamionController@show')->name('show-precio-camion');
  Route::get('/tipo-cambio', 'TipoCambioController@index')->name('tipo-cambio');
  Route::put('/actualizar-cambio', 'TipoCambioController@update')->name('updateCambio');
  Route::get('/mostrar-cambio', 'TipoCambioController@show')->name('showCambio');
  Route::post('/actualizar-ofertas', 'PrecioCamionController@update')->name('actualizar-ofertas');
// --------------------------------
  Route::get('/gestion-camion', 'GestionCamionController@index')->name('gestion-camion');
  Route::GET('/ver-camion', 'GestionCamionController@show')->name('showCamion');
  Route::get('/obtener-camion', 'GestionCamionController@getcamion')->name('getCamion');
  Route::get('/tabla-camion', 'GestionCamionController@gettablecamion')->name('gettableCamion');
  Route::get('/select-clasificacion', 'GestionCamionController@getclasificacion')->name('getClasificacion');
  Route::get('/test', 'GestionCamionController@test')->name('test');
  Route::get('/gestion-camion-r', 'GestionCamionController@indexr')->name('gestion-camion-r');
  Route::GET('/ver-camion-r', 'GestionCamionController@showr')->name('showCamion-r');
  Route::get('/obtener-camion-r', 'GestionCamionController@getcamionr')->name('getCamion-r');
  Route::get('/tabla-camion-r', 'GestionCamionController@gettablecamionr')->name('gettableCamion-r');
  Route::POST('/actualizar-camion', 'GestionCamionController@updateitem')->name('updateitem');
  Route::get('/datos-generales', 'GestionCamionController@generalCamion')->name('generalCamion');
  Route::POST('/actualizar-camion-general', 'GestionCamionController@updategeneralCamion')->name('updategeneralCamion');
  Route::POST('/actualizar-camion-fecha', 'GestionCamionController@updategeneralFecha')->name('updategeneralFecha');
  Route::POST('/actualizar-camion-embarque', 'GestionCamionController@updategeneralEmbarque')->name('updategeneralEmbarque');
  Route::POST('/actualizar-camion-valor-total', 'GestionCamionController@updategeneralValorTotal')->name('updategeneralValorTotal');
  Route::get('/switch-item', 'GestionCamionController@switchitem')->name('switchitem');
  Route::get('/fecha-embarque', 'GestionCamionController@getembarque')->name('getembarque');
  Route::get('/cambiar-bloqueo-camion', 'GestionCamionController@changeBloqueoCamion')->name('changecamion');
// ------------------------

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
  Route::post('/productos/delete', 'ProductController@deleteProduct')->name('product.delete');

//---------------------------------------Contabilidad - Retiros prosegur
  Route::get('/contabilidad', 'ContabilidadController@index')->name('contabilidad.index');
  Route::get('/obtener-retiro', 'ContabilidadController@getRetiro')->name('getRetiro');
  Route::get('/obtener-retiro-detalle', 'ContabilidadController@getRetiroDetalle')->name('getRetiroDetalle');
  Route::get('/obtener-otro-retiro', 'ContabilidadController@getOtroRetiro')->name('getOtroRetiro');
  Route::get('/obtener-depositos-pendientes', 'ContabilidadController@getRetiroPendiente')->name('getRetiroPendiente');
  Route::get('/retiros-generar', 'ContabilidadController@upRetiro')->name('subirRetiro');
  Route::get('/retiros-otros-generar', 'ContabilidadController@upOtroRetiro')->name('subirOtroRetiro');
  Route::get('/eliminar-item', 'ContabilidadController@deleteItemRetiro')->name('eliminarItemRetiro');
  Route::get('/deposito-incluir-deposito', 'ContabilidadController@IncluirRetiro')->name('IncluirRetiro');
// ----------------------------------------------------------------------------------------------------------------------------------
Route::get('prueba', 'ContabilidadController@prueba')->name('prueba');



  Route::get('/ingreso-cartolas', 'IngresoCartolaController@index')->name('cartola.indxe');

  Route::get('/reporte-prosegur-resumen/{fecha1}/{fecha2}', 'ContabilidadController@reporteResumenProsegur')->name('reporteResumenProsegur');

  Route::get('/reporte-comision/{year}/{mes}/{sucursal}/{vendedor}', 'ComicionVentaController@reporteComisionVenta')->name('reporteComisionVenta');

  Route::get('/reporte', function () {

    $mpdf = new \Mpdf\Mpdf([
      'margin_left' => 20,
      'margin_right' => 15,
      'margin_top' => 48,
      'margin_bottom' => 25,
      'margin_header' => 10,
      'margin_footer' => 10
    ]);

    $mpdf->SetProtection(array('print'));
    $mpdf->SetTitle("Resumen de transacciones");
    $mpdf->SetAuthor("Las Brasas");
    $mpdf->SetWatermarkText("LAS BRASAS");
    $mpdf->showWatermarkText = true;
    $mpdf->watermark_font = 'DejaVuSansCondensed';
    $mpdf->watermarkTextAlpha = 0.1;
    $mpdf->SetDisplayMode('fullpage');
    $html =view('reports.prosegur.resumen-retiros')->render();
    $mpdf->WriteHTML($html);

    $mpdf->Output();

  });

  Route::get('contenedores-camiones/pagos', 'ContenedorController@pagos')->name('contenedor.pagos');
  Route::get('contenedores-camiones/parametros', 'ContenedorController@parametros')->name('contenedor.parametros');

  Route::get('comicion-por-venta', 'ComicionVentaController@index')->name('comicion.venta');
  Route::get('obtener-mes','ComicionVentaController@getMes')->name('getMes');
  Route::get('obtener-sucursal','ComicionVentaController@getSucursal')->name('getSucursal');
  Route::get('obtener-vendedor','ComicionVentaController@getVendedor')->name('getVendedor');
  Route::get('obtener-reporte','ComicionVentaController@getComision')->name('getComision');
  Route::get('obtener-detalles','ComicionVentaController@getDetalles')->name('getDetalles');

  Route::post('cartola/importar','CatalogoController@import')->name('catalogo.import');
  Route::post('cartola/migracion','CatalogoController@migracion')->name('catalogo.migracion');


  Route::post('cartola/importar-plane','CatalogoController@importPlane')->name('catalogo.importPlane');
  Route::post('cartola/migracion-plane','CatalogoController@migraciontPlane')->name('catalogo.migrationPlane');

  //-------------------------------------MODULO 4
  Route::get('/proveedor','ContenedorController@getProveedor')->name('getProveedor');

Route::get('/reporte2', function () {

  $mpdf = new \Mpdf\Mpdf([
    'margin_left' => 20,
    'margin_right' => 15,
    'margin_top' => 48,
    'margin_bottom' => 25,
    'margin_header' => 10,
    'margin_footer' => 10
  ]);
  $mpdf->SetProtection(array('print'));
  $mpdf->SetTitle("Resumen de transacciones");
  $mpdf->SetAuthor("Las Brasas");
  $mpdf->SetWatermarkText("LAS BRASAS");
  $mpdf->showWatermarkText = true;
  $mpdf->watermark_font = 'DejaVuSansCondensed';
  $mpdf->watermarkTextAlpha = 0.1;
  $mpdf->SetDisplayMode('fullpage');
  $html =view('reports.prosegur.resumen-general')->render();
  $mpdf->WriteHTML($html);

  $mpdf->Output();
  });
  Route::get('/reporte3', function () {

    $mpdf = new \Mpdf\Mpdf([
      'margin_left' => 20,
      'margin_right' => 15,
      'margin_top' => 48,
      'margin_bottom' => 25,
      'margin_header' => 10,
      'margin_footer' => 10
    ]);
    $mpdf->SetProtection(array('print'));
    $mpdf->SetTitle("Resumen de transacciones");
    $mpdf->SetAuthor("Las Brasas");
    $mpdf->SetWatermarkText("LAS BRASAS");
    $mpdf->showWatermarkText = true;
    $mpdf->watermark_font = 'DejaVuSansCondensed';
    $mpdf->watermarkTextAlpha = 0.1;
    $mpdf->SetDisplayMode('fullpage');
    $html =view('reports.prosegur.detalle-depositos')->render();
    $mpdf->WriteHTML($html);
    $mpdf->Output();

  });



});
