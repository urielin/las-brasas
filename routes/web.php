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
  Route::get('/email', 'PrecioCamionController@sendEmail')->name('sendEmail');

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
  Route::get('/camiones-vencidos', 'GestionCamionController@vencidoCamion')->name('vencidoCamion');
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
  Route::get('/productos/getLastId', 'ProductController@getLastId')->name('product.getLastId');
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

//D------Administracion-camiones-------------------------------------------

Route::get('/gestion-administracion', 'GestionAdministracionController@index')->name('gestion-administracion.index');
Route::get('/administrar-tabla-codigo', 'GestionAdministracionController@administrarTablaCodigo')->name('administrarTablaCodigo');
Route::get('/administrar-tabla-clasificacion', 'GestionAdministracionController@administrarTablaClasificacion')->name('administrarTablaClasificacion');
Route::get('/administrar-tabla-estado', 'GestionAdministracionController@administrarTablaClasificacion')->name('administrarTablaEstado');
Route::get('/administrar-tabla-gestion', 'GestionAdministracionController@administrarTablaClasificacion')->name('administrarTablaGestion');  
Route::get('/detalle-administrar-camion', 'GestionAdministracionController@administrarDetalleCamion')->name('administrarDetalleCamion');
Route::POST('/subir-datosGenerales', 'GestionAdministracionController@upDatosGenerales')->name('upDatosGenerales');
Route::POST('/subir-datosLogistica', 'GestionAdministracionController@upDatosLogistica')->name('upDatosLogistica');
Route::POST('/subir-datosTecnicos', 'GestionAdministracionController@upDatosTecnicos')->name('upDatosTecnicos');
Route::POST('/subir-camion', 'GestionAdministracionController@administrarAgregarCamion')->name('administrarAgregarCamion');
Route::get('/prueba', 'GestionAdministracionController@prueba')->name('prueba');

//-----------------------------------------------------------------------

  Route::get('/ingreso-cartolas', 'IngresoCartolaController@index')->name('cartola.indxe');

  Route::get('/reporte-prosegur-resumen/{fecha1}/{fecha2}', 'ContabilidadController@reporteResumenProsegur')->name('reporteResumenProsegur');

  Route::get('/reporte-comision/{year}/{mes}/{sucursal}/{vendedor}', 'ComicionVentaController@reporteComisionVenta')->name('reporteComisionVenta');
  Route::get('/reporte-resumen/{year}/{mes}/{sucursal}/{vendedor}', 'ComicionVentaController@reportesComisionVenta')->name('reportesComisionVenta');


  Route::get('/reporte-comision1/{year}/{mes}/{sucursal}/{vendedor}', 'ComicionVentaController@reporteComisionVenta1')->name('reporteComisionVenta1');
  Route::get('/reporte-resumen1/{year}/{mes}/{sucursal}/{vendedor}', 'ComicionVentaController@reportesComisionVenta1')->name('reportesComisionVenta1');

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

  Route::get('contenedores-camiones/find-one', 'ContenedorController@findOne')->name('contenedor.findOne');
  Route::get('contenedores-camiones/pagos', 'ContenedorController@pagos')->name('contenedor.pagos');
  Route::get('contenedores-camiones/parametros', 'ContenedorController@parametros')->name('contenedor.parametros');

  /*PRUEBAAAAAAAAAAAAAAAAAAAAAAAA*/
  Route::get('contenedores-camiones/parametros1', 'ContenedorController@parametros1')->name('contenedor.parametros1');

  Route::get('contenedores-camiones/paginador', 'ContenedorController@paginador')->name('contenedor.paginador');

  Route::get('contenedores-camiones/proveedors','ContenedorController@paginadorProveedor')->name('paginateProveedor');
  /*PRUEBAAAAAAAAAAAAAAAAAAAAAAAA*/
  Route::post('contenedores-camiones/pagos/update', 'ContenedorController@update')->name('contenedor.pagos.update');
  Route::post('contenedores-camiones/pagos/check', 'ContenedorController@check')->name('contenedor.pagos.check');
  Route::get('contenedores-camiones/histories', 'ContenedorController@histories')->name('contenedor.histories');


  Route::get('comicion-por-venta', 'ComicionVentaController@index')->name('comicion.venta');
  Route::get('obtener-mes','ComicionVentaController@getMes')->name('getMes');
  Route::get('obtener-sucursal','ComicionVentaController@getSucursal')->name('getSucursal');
  Route::get('obtener-vendedor','ComicionVentaController@getVendedor')->name('getVendedor');
  Route::get('obtener-reporte','ComicionVentaController@getComision')->name('getComision');
  Route::get('validacion','ComicionVentaController@validacion')->name('validacion');
  Route::get('obtener-detalles','ComicionVentaController@getDetalles')->name('getDetalles');
  Route::get('obtener-detalles1','ComicionVentaController@getDetalles1')->name('getDetalles1');
  Route::get('obtener-reporte1','ComicionVentaController@getComision1')->name('getComision1');
  Route::get('exportar-datos','ComicionVentaController@setDatos')->name('setDatos');
  Route::post('updatevendedor','ComicionVentaController@updateVendedor')->name('updatevendedor');
  Route::get('comisiones-vendedor','ComicionVentaController@comisiones')->name('comisionesVendedor');
  /*Pruebaaaaa*/
  Route::get('comisiones-vendedor1','ComicionVentaController@comisiones1')->name('comisionesVendedor1');
  /*Pruebaaaaa*/
  Route::post('cartola/importar','CatalogoController@import')->name('catalogo.import');
  Route::post('cartola/migracion','CatalogoController@migracion')->name('catalogo.migracion');
  //Route::resource('email','ComicionVentaController@sendEmail')->name('email');


  Route::post('cartola/importar-plane','CatalogoController@importPlane')->name('catalogo.importPlane');
  Route::post('cartola/migracion-plane','CatalogoController@migraciontPlane')->name('catalogo.migrationPlane');

  Route::get('/proveedor','ContenedorController@getProveedor')->name('getProveedor');
  Route::get('/obtener-datos','ContenedorController@getDato')->name('getDato');
  Route::post('/nuevo','ContenedorController@setNew')->name('setNew');
  Route::get('/get-new','ContenedorController@getNew')->name('getNew');
  //Route::get('/get-new','ContenedorController@getNew')->name('getNew');
  Route::post('/updateproveedor','ContenedorController@updateProveedor')->name('updateProveedor');

  /*PAGINADOR*/

  Route::get('contenedores-camiones/paginador', 'ContenedorController@paginador')->name('contenedor.paginador');
  Route::get('contenedores-camiones/find-one', 'ContenedorController@findOne')->name('contenedor.findOne');
  Route::get('contenedores-camiones/pagos', 'ContenedorController@pagos')->name('contenedor.pagos');
  Route::get('contenedores-camiones/parametros', 'ContenedorController@parametros')->name('contenedor.parametros');
  Route::post('contenedores-camiones/pagos/update', 'ContenedorController@update')->name('contenedor.pagos.update');
  Route::post('contenedores-camiones/pagos/check', 'ContenedorController@check')->name('contenedor.pagos.check');
  Route::get('contenedores-camiones/histories', 'ContenedorController@histories')->name('contenedor.histories');





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


/*PRIMERO*/
/*
CREATE TABLE [dbo].[ADM_VENDEDOR_PARAMETROS_COMISION](
	[id_vendedor] [int] NOT NULL,
	[nombre_vendedor] [varchar](100) NULL

 CONSTRAINT [PK_ADM_VENDEDOR_PARAMETROS_COMISION] PRIMARY KEY CLUSTERED
(
	[id_vendedor] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/*SEGUNDO*/
/*
CREATE TABLE [dbo].[MODULO_COMISION_VENTA_HIST](
	[folio] [varchar](50) NULL,
	[id_venta] [bigint] NOT NULL,
	[proc_folio_pedido] [numeric](18, 0) NULL,
	[fecha2] [datetime] NULL,
	[forma_pago] [numeric](18, 0) NULL,
	[cod_vendedor] [numeric](18, 0) NOT NULL,
	[ptotal] [numeric](18, 2) NULL,
	[impuesto] [numeric](18, 0) NULL,
	[adicional] [numeric](18, 0) NULL,
	[total] [numeric](18, 0) NULL,
	[rut_cliente] [varchar](50) NULL,
	[comision] [numeric](18, 2) NULL,
	[fecha_pago] [datetime] NULL,
	[monto] [numeric](18, 0) NULL,
	[tipo_documento] [numeric](18, 0) NULL,
	[n_deposito] [nvarchar](20) NULL,
 CONSTRAINT [PK_MODULO_COMISION_VENTA_HIST] PRIMARY KEY CLUSTERED
(
	[id_venta] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/*TERCERO*/
/*
INSERT INTO ADM_VENDEDOR_PARAMETROS_COMISION
 SELECT VEND_CODIGO, VEND_NOMBRE FROM ADM_VENDEDORES
/*CUARTO*//*
 ALTER TABLE ADM_VENDEDOR_PARAMETROS_COMISION
 ADD [nivel1] [int] NULL,
	[comision1] [int] NULL,
	[nivel2] [int] NULL,
	[comision2] [int] NULL,
	[nivel3] [int] NULL,
	[comision3] [int] NULL
*/
