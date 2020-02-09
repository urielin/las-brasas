@extends('layouts.dashboard')

@section('content')


<h5>Contenedores / Camiones - PARA RECEPCIÓN</h5> 

<br>

  <div class="row">
    <div class="col s4">
      <div class="card card card-default scrollspy">
          <div class="row pt-2 pb-3">
            <form  method="post" id="buscar-camion" class="col s12">
              <div class="row">
                <div class="input-field col s12">
                  @csrf
                  <label for="buscar-codigo-camion">Buscar camión</label>
                  <input type="hidden" name="action" id="action-buscar-camion"  value="buscar-camion">
                  <input type="text" name="codigo" class="validate form-control" id="buscar-codigo-camion" placeholder="Ingrese código camión">
                </div>
              </div>

              <div class="row">
                <div class="input-field col s12">
                  <button type="submit" name="actualizar" class="btn btn-primary mt-1 float-right">Buscar</button>
                </div>
              </div>
            </form>
          </div>
      </div>
    </div>

    {{-- ------------------------------------------- --}}

    <div class="col s8">
      <div class="card card card-default scrollspy">
            <div class="row pt-4 pb-4">
              <form class="col s12">
                <div class="row">
                  <div class="input-field col s3">
                    <label for="anios">Ingresar año</label>
                    <select class="form-control browser-default" id="anio">
                      <option>Año</option>
                      @foreach ($year as $y)
                        <option value="{{$y->TP_GESTION}}" >{{$y->TP_GESTION}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="input-field col s4">
                    <label for="clasificacion">Clasificar camión </label>
                    <select class="form-control browser-default" id="clasificacion">
                    </select>
                  </div>
                  <div class="input-field col s5">
                    <input type="hidden" name="action" id="icamion"  value="camion">
                    <label for="camion">Seleccionar camión </label>
                    <select class="form-control browser-default" value="camion" id="camion">
                    </select>
                  </div>
                </div>
              </form>
            </div>
        </div>
    </div>
  </div>

  <hr>

  <div class="row">
    <div class="col s12">
      <div class="card card card-default scrollspy">
          <div class="row pb-4">
                  <div class="col s12">
                    <ul class="tabs">
                      <li class="tab col m6"><a class="active" href="#test1">Detalle</a></li>
                      <li class="tab col m6"><a href="#test2">Actualizar</a></li>
                    </ul>
                  </div>

                  <div id="test1" class="col s12">
                    <div class="row">
                        <div class="col s12 m12 l12">
                              <div id="responsive-table" class="card card card-default scrollspy">
                                <div class="card-content" style=" margin-top: -6px; overflow: auto; height: 60vh; ">
                                  <h4 class="card-title"></h4>
                                  <p class="mb-2"></p>
                                  <div class="row">
                                    <div class="col s12">
                                    </div>
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

                  <div id="test2" class="col s12">
{{-- ------------------------- --}}
                        <div class="row">
                          <div class="col s12">
                            <ul class="tabs">
                              <li class="tab col m3"><a class="active" href="#uno">Datos de camión</a></li>
                              <li class="tab col s3"><a href="#dos">Fecha embarque y llegada</a></li>
                              {{-- <li class="tab col sm disabled"><a href="#tres">Forma de pago</a></li> --}}
                              <li class="tab col s3"><a href="#cuatro">Datos embarque y llegada</a></li>
                              <li class="tab col m3"><a href="#cinco">Valor total del camion</a></li>
                            </ul>
                          </div>
                          <div id="uno" class="col s12">
                            Datos de camión

                            <div class="row">
                              @php if ($datos != '[]') { @endphp @php } else { @endphp

                                      <span id="form_result_consulta1"></span>

                                          <form method="POST" id="consulta1" class="col s12">
                                                    @csrf

                                            <div class="card card card-default scrollspy pt-2 pb-3">
                                              <div class="row ">
                                                    <div class="input-field col s6">

                                                      <label for="icon_prefix">Código oficial</label>
                                                      <input class="form-control form-control-sm" name="codigo_oficial" id="codigo_oficial" type="text" >
                                                      <input type="hidden" class="form-control form-control-sm" name="codigo_oficial_real" id="codigo_oficial_real" type="text" >

                                                    </div>
                                                    <div class="input-field col s6">

                                                      <label for="icon_telephone">Código auxiliar</label>

                                                      <input class="validate form-control" name="codigo_auxiliar" id="codigo_auxiliar" type="text" >
                                                    </div>
                                              </div>

                                                <div class="row ">
                                                      <div class="input-field col s6">

                                                        <label for="icon_prefix">Nro de contenedor</label>
                                                        <input name="nro_de_contenedor" id="nro_de_contenedor" type="text" class="validate form-control">
                                                      </div>
                                                      <div class="input-field col s6">

                                                        <label for="icon_telephone">Nro BL</label>
                                                        <input name="nro_bl" id="nro_bl" type="text" class="validate form-control">
                                                      </div>
                                                </div>

                                                <div class="row ">
                                                      <div class="input-field col s6">

                                                        <label for="icon_prefix">Clasificación de mercancía</label>
                                                        <select class="form-control browser-default" name="clasificacion_de_mercancia" id="clasificacion_de_mercancia">

                                                        </select>
                                                      </div>
                                                      <div class="input-field col s6">

                                                        <label for="icon_telephone">Proveedor</label>
                                                        <input name="proveedor" id="proveedor" type="text" class="validate form-control">
                                                      </div>
                                                </div>

                                                <div class="row ">
                                                      <div class="input-field col s6">

                                                        <label for="icon_prefix">Marca origen</label>
                                                        <input name="marca_origen" id="marca_origen"  type="text" class="validate form-control">
                                                      </div>
                                                      <div class="input-field col s6">

                                                        <label for="icon_telephone">Pais origen</label>
                                                        <input name="pais_origen" id="pais_origen" type="text" class="validate form-control">
                                                      </div>
                                                </div>

                                                <div class="row ">
                                                      <div class="input-field col s6">

                                                        <label for="icon_prefix">Descripción</label>
                                                        <input name="descripcion" id="descripcion" type="text" class="validate form-control">
                                                      </div>
                                                      <div class="input-field col s6">

                                                        <label for="icon_telephone">Contenido</label>
                                                        <input name="contenido" id="contenido" type="tel" class="validate form-control">
                                                      </div>
                                                </div>

                                                <div class="row ">
                                                      <div class="input-field col s6">

                                                        <label for="icon_prefix">Observaciones</label>
                                                        <input name="observaciones" id="observaciones" type="text" class="validate form-control">
                                                      </div>
                                                      <div class="input-field col s6">

                                                        <label for="icon_telephone">Lugar de arribo</label>
                                                        <select class="form-control browser-default" name="lugar_de_arribo" id="lugar_de_arribo">

                                                        </select>
                                                      </div>
                                                </div>

                                                <div class="row ">
                                                      <div class="input-field col s12">

                                                        <span id="bandera-general"></span>
                                                        <input type="hidden" name="ac"  value="">
                                                        <input type="hidden" name="action" id="action" value="Editar">
                                                        <input type="submit" name="action_b1" id="action_b1" class="btn btn-primary mt-1 float-center" value="Actualizar">
                                                      </div>
                                                </div>
                                            </div>

                                          </form>
                                    @php } @endphp
                            </div>
                          </div>
{{-- ----------------------------------------------                             --}}

                          <div id="dos" class="col s12">
                            Fecha embarque y llegada

                            <div class="row">
                              @php if ($datos != '[]') { @endphp @php } else { @endphp

                                      <span id="form_result_consulta2"></span>
                                          <form  method="post" id="consulta2" class="col s12">
                                                    @csrf

                                            <div class="card card card-default scrollspy pt-2 pb-3">
                                              <div class="row ">
                                                    <div class="input-field col s12">

                                                      <label for="icon_prefix">Fecha de cierre</label>
                                                      <input class="form-control " name="fecha_de_cierre" id="fecha_de_cierre" type="datetime-local" >
                                                      <input type="hidden" class="form-control " name="codigo_oficial_real2" id="codigo_oficial_real2" type="text" >

                                                    </div>

                                              </div>

                                                <div class="row ">
                                                    <div class="input-field col s6">

                                                      <label for="icon_telephone">Fecha de embarque desde</label>

                                                      <input class="form-control" type="datetime-local" name="fecha_de_embarque_desde" id="fecha_de_embarque_desde" >
                                                    </div>

                                                      <div class="input-field col s6">
                                                        <label for="icon_prefix">Hasta</label>
                                                        <input name="fecha_de_embarque_desde_hasta" id="fecha_de_embarque_desde_hasta" type="datetime-local" class="form-control">
                                                      </div>

                                                </div>

                                                <div class="row ">
                                                      <div class="input-field col s6">

                                                        <label for="icon_telephone">Fecha de llegada desde</label>
                                                        <input type="datetime-local" name="fecha_de_llegada_desde" id="fecha_de_llegada_desde" class="form-control">
                                                      </div>
                                                      <div class="input-field col s6">
                                                        <label for="icon_prefix">Hasta</label>
                                                        <input  type="datetime-local" name="fecha_de_llegada_desde_hasta" id="fecha_de_llegada_desde_hasta" class="form-control">
                                                      </div>
                                                </div>

                                                <div class="row ">

                                                      <div class="input-field col s12">

                                                        <label for="icon_telephone">Observación</label>
                                                        <input type="text" name="observacion" id="observacion" class="validate form-control">
                                                      </div>
                                                </div>

                                                <div class="row ">
                                                      <div class="input-field col s12">
                                                        <input type="hidden" name="action" id="action_2" value="Editar">
                                                        <input type="submit" name="action_b2" id="action_b2" class="btn btn-primary mt-1 float-center" value="Actualizar">
                                                      </div>
                                                </div>
                                            </div>

                                          </form>
                                    @php } @endphp
                            </div>
                          </div>


{{-- --------------------------------------- --}}

                          <div id="cuatro" class="col s12">
                            Datos embarque y llegada
                            <div class="row">
                            @php if ($datos != '[]') { @endphp @php } else { @endphp

                                    <span id="form_result_consulta4"></span>
                                        <form method="POST" id="consulta4" class="col s12">
                                                  @csrf

                                          <div class="card card card-default scrollspy pt-2 pb-3">
                                            <div class="row ">
                                                  <div class="input-field col s6">

                                                    <label for="icon_prefix">Fecha de embarque real</label>
                                                    <input class="form-control form-control-sm" name="fecha_de_embarque_real" id="fecha_de_embarque_real" type="datetime-local" step="1" >
                                                    <input type="hidden" class="form-control form-control-sm" name="codigo_oficial_real4" id="codigo_oficial_real4" >

                                                  </div>
                                                  <div class="input-field col s6">

                                                    <label for="icon_telephone">Fecha de llegada</label>

                                                    <input class="validate form-control" name="fecha_de_llegada" id="fecha_de_llegada" type="datetime-local" step="1">
                                                  </div>
                                            </div>

                                              <div class="row ">
                                                    <div class="input-field col s6">

                                                      <label for="icon_prefix">Nro de contenedorResol. Sanitaria</label>
                                                      <input name="resol_sanitaria" type="text" id="resol_sanitaria" class="validate form-control">
                                                    </div>
                                                    <div class="input-field col s6">

                                                      <label for="icon_telephone">Fecha de Resol. Sanitaria</label>
                                                      <input name="fecha_de_resol_sanitaria" type="datetime-local" id="fecha_de_resol_sanitaria" class=" form-control" step="1">
                                                    </div>
                                              </div>

                                              <div class="row ">
                                                    <div class="input-field col s6">

                                                      <label for="icon_prefix">Forward</label>
                                                    <input name="forward" type="text" id="forward" class="validate form-control">
                                                    </div>
                                                    <div class="input-field col s6">

                                                      <label for="icon_telephone">Fecha Forward</label>
                                                      <input name="fecha_forward" type="datetime-local" id="fecha_forward" class="validate form-control" step="1">
                                                    </div>
                                              </div>

                                              <div class="row ">
                                                    <div class="input-field col s6">

                                                      <label for="icon_prefix">Fecha producción desde</label>
                                                      <input type="datetime-local" name="fecha_producción_desde" id="fecha_producción_desde" class="validate form-control" step="1">
                                                    </div>
                                                    <div class="input-field col s6">

                                                      <label for="icon_telephone">Hasta</label>
                                                      <input type="datetime-local" name="fecha_producción_desde_hasta" id="fecha_producción_desde_hasta" class="validate form-control" step="1">
                                                    </div>
                                              </div>

                                              <div class="row ">
                                                    <div class="input-field col s6">

                                                      <label for="icon_prefix">Fecha vencimiento desde</label>
                                                      <input type="datetime-local" name="fecha_vencimiento_desde" id="fecha_vencimiento_desde" class="validate form-control" step="1">
                                                    </div>
                                                    <div class="input-field col s6">

                                                      <label for="icon_telephone">Hasta</label>
                                                      <input type="datetime-local" name="fecha_vencimiento_desde_hasta" id="fecha_vencimiento_desde_hasta" class="validate form-control" step="1">
                                                    </div>
                                              </div>


                                              <div class="row ">
                                                    <div class="input-field col s12">


                                                      <input type="hidden" name="action" id="action4" value="Editar">
                                                      <input type="submit" name="action_b4" id="action_b4" class="btn btn-primary mt-1 float-center" value="Actualizar">
                                                    </div>
                                              </div>
                                          </div>

                                        </form>
                            @php } @endphp
                            </div>
                          </div>


                            {{-- ------------------------------- --}}


                          <div id="cinco" class="col s12">
                            Valor total del camion

                            <div class="row">
                              @php if ($datos != '[]') { @endphp @php } else { @endphp

                                      <span id="form_result_consulta5"></span>
                                          <form method="POST" id="consulta5" class="col s12">
                                                    @csrf

                                            <div class="card card card-default scrollspy pt-2 pb-3">
                                              <div class="row ">
                                                    <div class="input-field col s6">

                                                      <label for="icon_prefix">Factura proveedor</label>
                                                      <input class="form-control form-control-sm"  type="text" name="factura_proveedor" id="factura_proveedor" >
                                                      <input class="form-control form-control-sm" name="codigo_oficial_real5" id="codigo_oficial_real5" type="hidden" >

                                                    </div>
                                                    <div class="input-field col s6">

                                                      <label for="icon_telephone">Cantidad recibida</label>

                                                      <input class="validate form-control" type="text" name="cantidad_recibida" id="cantidad_recibida" >
                                                    </div>
                                              </div>

                                                <div class="row ">
                                                      <div class="input-field col s6">

                                                        <label for="icon_prefix">Unidad</label>
                                                        <select class="form-control browser-default" name="unidad" id="unidad">

                                                        </select>
                                                      </div>
                                                      <div class="input-field col s6">

                                                        <label for="icon_telephone">Valor total</label>
                                                        <input type="text" name="valor_total" id="valor_total" class="validate form-control">
                                                      </div>
                                                </div>

                                                <div class="row ">
                                                      <div class="input-field col s12">

                                                        <label for="icon_prefix">Tipo de moneda</label>
                                                        <select class="form-control browser-default" name="tipo_de_moneda" id="tipo_de_moneda">

                                                        </select>
                                                      </div>

                                                </div>

                                                <div class="row ">
                                                      <div class="input-field col s12">


                                                        <input type="hidden" name="action" id="action5" value="Editar">
                                                        <input type="submit" name="action_b5" id="action_b5" class="btn btn-warning" value="Actualizar">
                                                      </div>
                                                </div>
                                            </div>

                                          </form>
                                    @php } @endphp
                            </div>
                          </div>
                            {{-- ------------------------------------ --}}


                        </div>


{{-- -------------------------------------- --}}
                  </div>
          </div>
      </div>
    </div>
  </div>


@endsection

@section('js')
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
@section('js')

@endsection
