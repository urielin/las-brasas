@extends('layouts.dashboard')

@section('content')
  <div class="row">
    <div class="col s12">

    <div class="card card  card-default scrollspy">
      <div class="row"  style="padding:20px">
        <div style="display: flex; justify-content: space-between">
            <div style="display: flex">
              <i class="material-icons dp48">subject</i><span class="card-title">Contenedores / Camiones - RECEPCIONADOS</span>
            </div>
        </div>
        <div class="col s12 l4" style="margin-top: 20px;">
          <!--<div class="card card card-default scrollspy">-->
              <div class="row ">
                <form  method="post" id="buscar-camion" class="col s12">
                  <div class="row">
                    <div class="mb-1 col s12 l12">
                      @csrf
                      <label for="buscar-codigo-camion">Buscar camión</label>
                      <input type="hidden" name="action" id="action-buscar-camion"  value="buscar-camion-r">
                      <div class="input-group">
                        <input type="text" name="codigo" class="validate form-control browser-default " style="border-radius: 0px " id="buscar-codigo-camion" placeholder="Ingrese código camión">
                        <div class="input-group-append">
                          <button type="submit" name="actualizar" class="btn btn-50 cyan" style="border-radius: 0px !important; line-height: 45px !important; height:45px !important;width:46px !important">
                            <i class="material-icons dp48">search</i>
                          </button>
                        </div>
                      </div>

                    </div>

                  </div>
                </form>
              </div>
        <!--  </div>-->
        </div>
        <div class="col s12 l8" style="margin-top: 20px;">
          <!--<div class="card card card-default scrollspy">-->
                <div class="row ">
                  <form class="col s12" >
                    <div class="row">
                      <div class="col s12 l3">
                        <form >
                          <label for="anior">Ingresar año</label>
                          <select class="form-control browser-default" id="anior">
                            <option>Año</option>
                            @foreach ($year as $y)
                              <option value="{{$y->TP_GESTION}}" >{{$y->TP_GESTION}}</option>
                            @endforeach
                          </select>
                        </form>
                      </div>
                      <div class="col s12 l4">
                        <form>
                          <label for="clasificacion">Clasificar camión </label>
                          <select class="form-control browser-default" id="clasificacionr">
                          </select>
                        </form>
                      </div>
                      <div class="col s12 l5">
                        <form>
                          <input type="hidden" name="action" id="icamion"  value="camion-r">
                          <label for="camion">Seleccionar camión </label>
                          <select class="form-control browser-default" value="camion" id="camion">
                          </select>
                        </form>
                      </div>
                    </div>
                  </form>
                </div>
            <!--</div>-->
        </div>
      </div>
    </div>
    </div>
  </div>


  <div class="row">
    <div class="col s12">
      <div class="card card card-default scrollspy">
        <div class="row pb-4">
            <div class="col s12">
              <ul class="tabs">
                <li class="tab col m3"><a class="active" href="#test1">Detalle</a></li>
                <li class="tab col m3"><a href="#test2">Actualizado</a></li>
                <li class="tab col m6"><span id="bloquear-camion"></span></li>
              </ul>
            </div>
            <div id="test1" class="col s12">
              <div class="row">
                <div class="col s12 m12 l12">
                    <div id="responsive-table" class=" ">
                      <div class="card-content" style=" margin-top: -6px; overflow: auto; height: 60vh; ">
                        <h4 class="card-title"></h4>
                        <p class="mb-2"></p>
                        <div class="row">

                          <div class="col s12 dataTables_scrollBody">
                            <table class="responsive-table striped">
                                  <thead class="thead-light" id="camiontabla-head">
                                  </thead>
                                  <tbody id="camiontabla">
                                  </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <div id="test2" class="col s12" style="padding-top: 20px; padding-left: 40px; padding-right: 40px;">
                <div class="row">

                    <div class="tab">
                       <div class="tablinks" style="border-top-width: 1px;" id='openDefault' onclick="openCity(event, 'uno')">Datos de camión</div>
                       <div class='tablinks' onclick="openCity(event, 'dos')">Fecha embarque y llegada</div>
                       <div class='tablinks' onclick="openCity(event, 'cuatro')">Datos embarque y llegada</div>
                       <div class='tablinks' onclick="openCity(event, 'cinco')">Valor total del camión</div>
                    </div>

                  <div id="uno" class="tabcontent" >
                    <div class="row">
                      @php if ($datos != '[]') { @endphp @php } else { @endphp
                              <span id="form_result_consulta1"></span>
                                  <form method="POST" id="consulta1" class="col s12">
                                            @csrf
                                    <div class="form-horizontal form-inline">
                                      <div class="row">
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Código oficial: </label>
                                            <div class="col l6 m6 s6">
                                              <input disabled class="form-control form-control-sm browser-default" name="codigo_oficial" id="codigo_oficial" type="text" >
                                              <input type="hidden" class="form-control form-control-sm browser-default" name="codigo_oficial_real" id="codigo_oficial_real" type="text" >
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Código auxiliar: </label>
                                            <div class="col l6 m6 s6">
                                              <input disabled class="validate form-control browser-default" name="codigo_auxiliar" id="codigo_auxiliar" type="text" >
                                            </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Nro de contenedor: </label>
                                            <div class="col l6 m6 s6">
                                              <input disabled name="nro_de_contenedor" id="nro_de_contenedor" type="text" class="validate form-control browser-default">
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Nro BL: </label>
                                            <div class="col l6 m6 s6">
                                              <input disabled name="nro_bl" id="nro_bl" type="text" class="validate form-control browser-default">
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Clasificación de mercancía: </label>
                                            <div class="col l6 m6 s6">
                                              <select disabled class="form-control browser-default" name="clasificacion_de_mercancia" id="clasificacion_de_mercancia">
                                              </select>
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Proveedor: </label>
                                            <div class="col l6 m6 s6">
                                              <input disabled name="proveedor" id="proveedor" type="text" class="validate form-control browser-default">
                                            </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Marca origen: </label>
                                            <div class="col l6 m6 s6">
                                              <input disabled name="marca_origen" id="marca_origen"  type="text" class="validate form-control browser-default">
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">País origen: </label>
                                            <div class="col l6 m6 s6">
                                              <input disabled name="pais_origen" id="pais_origen" type="text" class="validate form-control browser-default">
                                            </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Descripción: </label>
                                            <div class="col l6 m6 s6">
                                              <input disabled name="descripcion" id="descripcion" type="text" class="validate form-control browser-default">
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Contenido: </label>
                                            <div class="col l6 m6 s6">
                                              <input disabled name="contenido" id="contenido" type="tel" class="validate form-control browser-default">
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Observaciones: </label>
                                            <div class="col l6 m6 s6">
                                              <input disabled name="observaciones" id="observaciones" type="text" class="validate form-control browser-default">
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Lugar de arribo: </label>
                                            <div class="col l6 m6 s6">
                                              <select disabled class="form-control browser-default" name="lugar_de_arribo" id="lugar_de_arribo">
                                              </select>
                                            </div>
                                          </div>
                                      </div>
                                      <div class="row ">
                                          <div class="col s12 l12">
                                            <span id="bandera-general"></span>
                                            <div class="col l6 m6 s6">
                                              <input disabled type="hidden" name="ac"  value="">
                                            </div>
                                          </div>
                                      </div>
                                    </div>

                                  </form>
                            @php } @endphp
                    </div>
                  </div>
                  <div id="dos" class="tabcontent" >

                    <div class="row">
                      @php if ($datos != '[]') { @endphp @php } else { @endphp
                              <span id="form_result_consulta2"></span>
                                  <form  method="post" id="consulta2" class="col s12">
                                            @csrf
                                 <div class="form-horizontal form-inline">

                                      <div class="row">
                                        <div class="form-group col s12 l12 pb-2">
                                            <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha de cierre: </label>
                                            <div class="col l6 m6 s6">
                                              <input disabled class="form-control browser-default" name="fecha_de_cierre" id="fecha_de_cierre" type="datetime-local" >
                                              <input type="hidden" class="form-control browser-default" name="codigo_oficial_real2" id="codigo_oficial_real2" type="text" >
                                            </div>
                                          </div>
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha de embarque desde: </label>
                                          <div class="col l6 m6 s6">
                                            <input disabled class="form-control browser-default" type="datetime-local" name="fecha_de_embarque_desde " id="fecha_de_embarque_desde" >
                                          </div>
                                        </div>
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Hasta: </label>
                                          <div class="col l6 m6 s6">
                                            <input disabled name="fecha_de_embarque_desde_hasta" id="fecha_de_embarque_desde_hasta" type="datetime-local" class="form-control browser-default">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha de llegada desde: </label>
                                          <div class="col l6 m6 s6">
                                            <input disabled type="datetime-local" name="fecha_de_llegada_desde" id="fecha_de_llegada_desde" class="form-control browser-default">
                                          </div>
                                        </div>
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Hasta: </label>
                                          <div class="col l6 m6 s6">
                                            <input  disabled type="datetime-local" name="fecha_de_llegada_desde_hasta" id="fecha_de_llegada_desde_hasta" class="form-control browser-default">
                                          </div>
                                        </div>
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Observación: </label>
                                          <div class="col l6 m6 s6">
                                            <input disabled type="text" name="observacion" id="observacion" class="validate form-control browser-default">
                                          </div>
                                        </div>
                                      </div>

                                    </div>
                                  </form>
                            @php } @endphp
                    </div>
                  </div>
                  <div id="cuatro" class="tabcontent">

                    <div class="row">
                    @php if ($datos != '[]') { @endphp @php } else { @endphp

                            <span id="form_result_consulta4"></span>
                                <form method="POST" id="consulta4" class="col s12">
                                          @csrf

                                 <div class="form-horizontal form-inline">
                                    <div class="row">
                                      <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha de embarque real: </label>
                                          <div class="col l6 m6 s6">
                                            <input disabled class="form-control form-control-sm browser-default" name="fecha_de_embarque_real" id="fecha_de_embarque_real" type="datetime-local" step="1" >
                                            <input type="hidden" class="form-control form-control-sm browser-default" name="codigo_oficial_real4" id="codigo_oficial_real4" >
                                          </div>

                                        </div>
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha de llegada: </label>
                                          <div class="col l6 m6 s6">
                                            <input disabled class="validate form-control browser-default" name="fecha_de_llegada" id="fecha_de_llegada" type="datetime-local" step="1">
                                          </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Nro de contenedorResol. Sanitaria: </label>
                                          <div class="col l6 m6 s6">
                                            <input disabled name="resol_sanitaria" type="text" id="resol_sanitaria" class="validate form-control browser-default">
                                          </div>
                                        </div>
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha de Resol. Sanitaria: </label>
                                          <div class="col l6 m6 s6">
                                            <input disabled name="fecha_de_resol_sanitaria" type="datetime-local" id="fecha_de_resol_sanitaria" class=" form-control browser-default" step="1">
                                          </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Forward: </label>
                                          <div class="col l6 m6 s6">
                                            <input disabled name="forward" type="text" id="forward" class="validate form-control browser-default">
                                          </div>
                                        </div>
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha Forward: </label>
                                          <div class="col l6 m6 s6">
                                            <input disabled name="fecha_forward" type="datetime-local" id="fecha_forward" class="validate form-control browser-default" step="1">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row ">
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha producción desde: </label>
                                          <div class="col l6 m6 s6">
                                            <input disabled type="datetime-local" name="fecha_producción_desde" id="fecha_producción_desde" class="validate form-control browser-default" step="1">
                                          </div>
                                        </div>
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Hasta: </label>
                                          <div class="col l6 m6 s6">
                                            <input disabled type="datetime-local" name="fecha_producción_desde_hasta" id="fecha_producción_desde_hasta" class="validate form-control browser-default" step="1">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row ">
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha vencimiento desde: </label>
                                          <div class="col l6 m6 s6">
                                            <input disabled type="datetime-local" name="fecha_vencimiento_desde" id="fecha_vencimiento_desde" class="validate form-control browser-default" step="1">
                                          </div>
                                        </div>
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Hasta: </label>
                                          <div class="col l6 m6 s6">
                                            <input disabled type="datetime-local" name="fecha_vencimiento_desde_hasta" id="fecha_vencimiento_desde_hasta" class="validate form-control browser-default" step="1">
                                          </div>
                                        </div>
                                      </div>
                                  </div>

                                </form>
                    @php } @endphp
                    </div>
                  </div>
                  <div id="cinco" class="tabcontent">

                    <div class="row">
                      @php if ($datos != '[]') { @endphp @php } else { @endphp
                              <span id="form_result_consulta5"></span>
                                  <form method="POST" id="consulta5" class="col s12">
                                            @csrf
                                   <div class="form-horizontal form-inline">
                                      <div class="row ">
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_prefix">Factura proveedor: </label>
                                          <div class="col l6 m6 s6">
                                            <input disabled class="form-control form-control-sm browser-default"  type="text" name="factura_proveedor" id="factura_proveedor" >
                                            <input class="form-control form-control-sm" name="codigo_oficial_real5" id="codigo_oficial_real5" type="hidden" >
                                          </div>
                                        </div>
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Cantidad recibida: </label>
                                          <div class="col l6 m6 s6">
                                            <input disabled class="validate form-control browser-default" type="text" name="cantidad_recibida" id="cantidad_recibida" >
                                          </div>
                                        </div>
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Unidad: </label>
                                          <div class="col l6 m6 s6">
                                            <select disabled class="form-control browser-default" name="unidad" id="unidad">
                                            </select>
                                          </div>
                                        </div>
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Valor total: </label>
                                          <div class="col l6 m6 s6">
                                            <input disabled type="text" name="valor_total" id="valor_total" class="validate form-control browser-default">
                                          </div>
                                        </div>
                                        <div class="form-group col s12 l12 pb-2">
                                              <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Tipo de moneda: </label>
                                              <div class="col l6 m6 s6">
                                                <select disabled class="form-control browser-default" name="tipo_de_moneda" id="tipo_de_moneda">
                                                </select>
                                              </div>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                            @php } @endphp
                    </div>
                  </div>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>


@endsection

@section('modal')

    <div id="formModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Editar producto</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <span id="form_result"></span>
            <form  method="POST" id="sample_form" class="form-horizontal">
              @csrf
              <div class="row container">
                  <input type="hidden" name="codigoreal" id="codigoreal" class="form-control" >
                  <input type="hidden" name="nro_itemreal" id="nro_itemreal" class="form-control">
                        <div class="row pb-3">
                          <div class="col-1"></div>
                          <div class="col-md">
                            <div class="row mb--2">
                              <label class="control-label ">Nro item: </label>
                            </div>
                            <div class="row">
                              <input type="text" name="nro_item" id="nro_item" class="form-control">
                            </div>
                          </div>
                          <div class="col-1"></div>
                          <div class="col-md">
                            <div class="row mb--2">
                              <label class="control-label ">Cantidad Ingreso: </label>
                            </div>
                            <div class="row">
                                <input type="text" name="cantidad_ingreso" id="cantidad_ingreso" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="row pb-3">
                  <div class="col-1"></div>
                  <div class="col-md">
                    <div class="row mb--2">
                      <label class="control-label">Código: </label>
                    </div>
                    <div class="row">
                      <input type="text" name="codigo" id="codigo" class="form-control">
                    </div>
                  </div>
                  <div class="col-1">
                  </div>
                  <div class="col-md">
                    <div class="row mb--2">
                      <label class="control-label ">Cantidad cierre: </label>
                    </div>
                    <div class="row">
                      <input type="text" name="cantidad_cierre" id="cantidad_cierre" class="form-control">
                    </div>
                  </div>
                </div>
                        <div class="row ">
                          <div class="col-2"></div>
                          <div class="col-10">
                            <div class="row mb--2">
                              <label class="control-label ">Bultos ingreso: </label>
                            </div>
                            <div class="row">
                              <input type="text" name="bultos_ingreso" id="bultos_ingreso" class="form-control">
                            </div>
                          </div>

                        </div>

              </div>

              <br />
              <div class="form-group" align="center">
                <input type="hidden" name="action" id="action-producto" >
                {{-- <input type="hidden" name="action" id="action" value="Editar"> --}}
                <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Actualizar">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection
@section('after-scripts')
    <script type="text/javascript" src="{{asset('js/tabs.js')}}"></script>
@endsection
