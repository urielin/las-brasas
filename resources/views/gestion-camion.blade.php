@extends('layouts.dashboard')

@section('content')


<div class="card card card-default scrollspy">
  <div class="row" style="padding:20px">
      <div style="display: flex; justify-content: space-between">
          <div style="display: flex">
            <i class="material-icons dp48">subject</i><span class="card-title">Contenedores / Camiones - PARA RECEPCIÓN</span>
          </div>
      </div>
      <div class="col s12 l4" style="margin-top: 20px;">
            <div class="">
              <div class="row">
                <form  method="post" id="buscar-camion" class="col s12">
                  <div class="row">
                    <div class="mb-1 col s12 l12">
                      @csrf
                      <label for="buscar-codigo-camion">Buscar camión</label>
                      <input type="hidden" name="action" id="action-buscar-camion"  value="buscar-camion">
                      <div class="input-group">
                        <input type="text" name="codigo" class="form-control browser-default" id="buscar-codigo-camion" placeholder="Ingrese código camión" style="border-radius:0px">
                        <div class="input-group-append">
                          <button type="submit" name="actualizar" class="btn btn-50 cyan " style="border-radius: 0px !important; line-height: 45px !important; height:45px !important;width:46px !important">
                            <i class="material-icons dp48">search</i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>


                </form>
              </div>
            </div>

      </div>
      <div class="col s12 l8" style="margin-top: 20px;">
        <div class="row">

          <div class="row ">
            <form class="col s12">
              <div class="row">

                <div class="col s12 l3">
                  <form class="" action="index.html" method="post">
                    <label for="anio" >Ingresar año</label>
                    <select class="form-control browser-default" id="anio">
                      <option>Año</option>
                      @foreach ($year as $y)
                      <option value="{{$y->TP_GESTION}}" >{{$y->TP_GESTION}}</option>
                      @endforeach
                    </select>
                  </form>
                </div>
                <div class="col s12 l4">
                  <form >
                    <label for="clasificacion">Clasificar camión </label>
                    <select class="form-control browser-default" id="clasificacion">
                    </select>
                  </form>
                </div>

                <div class="col s12 l5">
                  <form >
                    <input type="hidden" name="action" id="icamion"  value="camion">
                    <label for="camion">Seleccionar camión </label>
                    <select class="form-control browser-default" value="camion" id="camion">
                    </select>
                  </form>
                </div>
              </div>
            </form>
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
                      <li class="tab col m6"><a class="active" href="#test1">Detalle</a></li>
                      <li class="tab col m6"><a href="#test2">Actualizar</a></li>
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
                  <div id="test2" class="col s12" style="padding-top: 20px; padding-left: 40px; padding-right: 40px;">
                        <div class="row">
                            <div class="tab">
                               <div class="tablinks" style="border-top-width: 1px;" id='openDefault' onclick="openCity(event, 'uno')">Datos de camión</div>
                               <div class='tablinks' onclick="openCity(event, 'dos')">Fecha embarque y llegada</div>
                               <div class='tablinks' onclick="openCity(event, 'cuatro')">Datos embarque y llegada</div>
                               <div class='tablinks' onclick="openCity(event, 'cinco')">Valor total del camión</div>
                            </div>

                          <div id="uno" class="tabcontent" >


                            <div class="row ">
                              <div class="col l12">
                                @php if ($datos != '[]') { @endphp @php } else { @endphp

                                  <span id="form_result_consulta1"></span>

                                  <form method="POST" id="consulta1" class="col s12 form-group">
                                    @csrf
                                    <div class="form-horizontal form-inline">
                                      <div class="row">
                                         <div class="form-group col s12 l12 pb-2">
                                          <label class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Código oficial: </label>
                                          <div class="col l6 m6 s6">
                                            <input class="form-control browser-default" name="codigo_oficial" id="codigo_oficial" type="text" >
                                            <input type="hidden" class="form-control form-control-sm" name="codigo_oficial_real" id="codigo_oficial_real" type="text" >
                                          </div>
                                        </div>
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Código auxiliar: </label>
                                          <div class="col l6 m6 s6">
                                            <input class=" form-control browser-default" name="codigo_auxiliar" id="codigo_auxiliar" type="text" >
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Nro de contenedor: </label>
                                            <div class="col l6 m6 s6">
                                              <input name="nro_de_contenedor" id="nro_de_contenedor" type="text" class="browser-default form-control">
                                            </div>
                                        </div>
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Nro BL: </label>
                                          <div class="col l6 m6 s6">
                                            <input name="nro_bl" id="nro_bl" type="text" class="browser-default form-control">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Clasificación de mercancía: </label>
                                          <div class="col l6 m6 s6">
                                            <select class="form-control browser-default" name="clasificacion_de_mercancia" id="clasificacion_de_mercancia">
                                            </select>
                                          </div>
                                        </div>
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Proveedor: </label>
                                          <div class="col l6 m6 s6">
                                            <input name="proveedor" id="proveedor" type="text" class="validate form-control browser-default">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Marca origen: </label>
                                          <div class="col l6 m6 s6">
                                            <input name="marca_origen" id="marca_origen"  type="text" class="browser-default form-control">
                                          </div>
                                        </div>
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">País origen: </label>
                                            <div class="col l6 m6 s6">
                                              <input name="pais_origen" id="pais_origen" type="text" class="browser-default form-control">
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="form-group col s12 l12  pb-2">

                                          <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Descripción: </label>
                                          <div class="col l6 m6 s6">
                                              <input name="descripcion" id="descripcion" type="text" class="browser-default form-control">
                                          </div>
                                        </div>
                                        <div class="form-group col s12 l12  pb-2">

                                          <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Contenido: </label>
                                          <div class="col l6 m6 s6">
                                            <input name="contenido" id="contenido" type="tel" class="browser-default form-control">
                                          </div>
                                        </div>

                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Lugar de arribo: </label>
                                          <div class="col l6 m6 s6">
                                            <select class="form-control browser-default" name="lugar_de_arribo" id="lugar_de_arribo"></select>
                                          </div>
                                        </div>
                                        <div class="form-group col s12 l12 pb-2">
                                          <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Observaciones: </label>
                                          <div class="col l6 m6 s6">
                                            <textarea name="observaciones" id="observaciones" rows="6" cols='20' type="text" class=" form-control-textarea browser-default"></textarea>
                                          </div>
                                        </div>
                                        <div class="form-group col s12 l12 " style="display: flex;   justify-content: flex-end;">
                                          <span id="bandera-general"></span>
                                          <input type="hidden" name="ac"  value="">
                                          <input type="hidden" name="action" id="action" value="Editar">
                                          <div class="col l6 m6 s6">
                                            <input type="submit" name="action_b1" id="action_b1" class="btn cyan mt-1 float-center" value="Actualizar">
                                          </div>
                                        </div>
                                      </div>


                                    </div>

                                  </form>
                                  @php } @endphp
                              </div>

                            </div>


                          </div>
                          <div id="dos" class="tabcontent"  style="padding-top:20px">


                            <div class="row">
                              @php if ($datos != '[]') { @endphp @php } else { @endphp

                                      <span id="form_result_consulta2"></span>
                                          <form  method="post" id="consulta2" class="col s12">
                                                    @csrf

                                            <div class="form-horizontal form-inline">


                                                <div class="row">
                                                  <div class="form-group col s12 l12  pb-2">

                                                    <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha de cierre:</label>
                                                    <div class="col l6 m6 s6">
                                                      <input class="form-control browser-default" name="fecha_de_cierre" id="fecha_de_cierre" type="datetime-local" >
                                                      <input type="hidden" class="form-control " name="codigo_oficial_real2" id="codigo_oficial_real2" type="text" >
                                                    </div>

                                                  </div>
                                                    <div class="form-group col s12 l12  pb-2">

                                                      <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha de embarque desde:</label>
                                                      <div class="col l6 m6 s6">
                                                        <input class="form-control browser-default" type="datetime-local" name="fecha_de_embarque_desde" id="fecha_de_embarque_desde" >
                                                      </div>
                                                    </div>

                                                      <div class="form-group col s12 l12  pb-2">
                                                        <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Hasta:</label>
                                                        <div class="col l6 m6 s6">
                                                            <input name="fecha_de_embarque_desde_hasta" id="fecha_de_embarque_desde_hasta" type="datetime-local" class="form-control browser-default">
                                                        </div>
                                                      </div>

                                                </div>

                                                <div class="row">
                                                      <div class="form-group col s12 l12  pb-2">

                                                        <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha de llegada desde:</label>
                                                        <div class="col l6 m6 s6">
                                                          <input type="datetime-local" name="fecha_de_llegada_desde" id="fecha_de_llegada_desde" class="form-control browser-default">
                                                        </div>
                                                      </div>
                                                      <div class="form-group col s12 l12 pb-2">
                                                        <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Hasta:</label>
                                                        <div class="col l6 m6 s6">
                                                          <input  type="datetime-local" name="fecha_de_llegada_desde_hasta" id="fecha_de_llegada_desde_hasta" class="form-control browser-default">
                                                        </div>
                                                      </div>
                                                      <div class="form-group col s12 l12 pb-2">

                                                        <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Observación:</label>
                                                        <div class="col l6 m6 s6">
                                                          <textarea type="text" name="observacion" id="observacion" rows='5' cols='26' class="validate form-control-textarea browser-default"></textarea>
                                                        </div>
                                                      </div>
                                                      <div class="form-group col s12 l12 pb-2" style="display: flex;   justify-content: flex-end;">
                                                        <input type="hidden" name="action" id="action_2" value="Editar">
                                                        <div class="col l6 m6 s6">
                                                          <input type="submit" name="action_b2" id="action_b2" class="btn cyan mt-1 float-center" value="Actualizar">
                                                         </div>
                                                      </div>
                                                </div>

                                            </div>

                                          </form>
                                    @php } @endphp
                            </div>
                          </div>
                          <div id="cuatro" class="tabcontent"  style="padding-top:20px">

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
                                                      <input class="form-control browser-default" name="fecha_de_embarque_real" id="fecha_de_embarque_real" type="datetime-local" step="1" >
                                                      <input type="hidden" class="form-control browser-default" name="codigo_oficial_real4" id="codigo_oficial_real4" >
                                                    </div>
                                                  </div>
                                                  <div class="form-group col s12 l12 pb-2">
                                                    <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha de llegada: </label>
                                                    <div class="col l6 m6 s6">
                                                      <input class="validate form-control browser-default" name="fecha_de_llegada" id="fecha_de_llegada" type="datetime-local" step="1">
                                                    </div>
                                                  </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col s12 l12 pb-2">
                                                  <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Nro de contenedorResol. Sanitaria: </label>
                                                  <div class="col l6 m6 s6">
                                                    <input name="resol_sanitaria" type="text" id="resol_sanitaria" class="validate form-control browser-default">
                                                  </div>
                                                </div>
                                                <div class="form-group col s12 l12 pb-2">
                                                  <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha de Resol. Sanitaria: </label>
                                                  <div class="col l6 m6 s6">
                                                    <input name="fecha_de_resol_sanitaria" type="datetime-local" id="fecha_de_resol_sanitaria" class=" form-control browser-default" step="1">
                                                  </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                  <div class="form-group col s12 l12 pb-2">
                                                    <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Forward: </label>
                                                    <div class="col l6 m6 s6">
                                                      <input name="forward" type="text" id="forward" class="validate form-control browser-default">
                                                    </div>
                                                  </div>
                                                  <div class="form-group col s12 l12 pb-2">
                                                    <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha Forward: </label>
                                                    <div class="col l6 m6 s6">
                                                      <input name="fecha_forward" type="datetime-local" id="fecha_forward" class="validate form-control browser-default" step="1">
                                                    </div>
                                                  </div>
                                            </div>

                                              <div class="row">
                                                    <div class="form-group col s12 l12 pb-2">
                                                      <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha producción desde: </label>
                                                      <div class="col l6 m6 s6">
                                                        <input type="datetime-local" name="fecha_producción_desde" id="fecha_producción_desde" class="validate form-control browser-default" step="1">
                                                      </div>
                                                    </div>
                                                    <div class="form-group col s12 l12 pb-2">
                                                      <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Hasta: </label>
                                                      <div class="col l6 m6 s6">
                                                        <input type="datetime-local" name="fecha_producción_desde_hasta" id="fecha_producción_desde_hasta" class="validate form-control browser-default" step="1">
                                                      </div>
                                                    </div>
                                              </div>
                                              <div class="row">
                                                    <div class="form-group col s12 l12 pb-2">
                                                      <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha vencimiento desde: </label>
                                                      <div class="col l6 m6 s6">
                                                        <input type="datetime-local" name="fecha_vencimiento_desde" id="fecha_vencimiento_desde" class="validate form-control browser-default" step="1">
                                                      </div>
                                                    </div>
                                                    <div class="form-group col s12 l12 pb-2">
                                                      <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Hasta: </label>
                                                      <div class="col l6 m6 s6">
                                                        <input type="datetime-local" name="fecha_vencimiento_desde_hasta" id="fecha_vencimiento_desde_hasta" class="validate form-control browser-default" step="1">
                                                      </div>
                                                    </div>
                                                    <div class="form-group col s12 l12 pb-2" style="display: flex;   justify-content: flex-end;">
                                                      <input type="hidden" name="action" id="action4" value="Editar">
                                                      <div class="col l6 m6 s6">
                                                        <input type="submit" name="action_b4" id="action_b4" class="btn cyan" value="Actualizar">
                                                      </div>
                                                    </div>
                                              </div>
                                          </div>

                                        </form>
                            @php } @endphp
                            </div>
                          </div>
                          <div id="cinco" class="tabcontent"  style="padding-top:20px">
                            <div class="row">
                              @php if ($datos != '[]') { @endphp @php } else { @endphp

                                      <span id="form_result_consulta5"></span>
                                          <form method="POST" id="consulta5" class="col s12">
                                                    @csrf

                                            <div class="form-horizontal form-inline">

                                              <div class="row">
                                                <div class="form-group col s12 l12 pb-2">
                                                      <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Factura proveedor: </label>
                                                      <div class="col l6 m6 s6">
                                                        <input class="form-control browser-default"  type="text" name="factura_proveedor" id="factura_proveedor" >
                                                        <input class="form-control form-control-sm" name="codigo_oficial_real5" id="codigo_oficial_real5" type="hidden" >
                                                      </div>

                                                    </div>
                                                    <div class="form-group col s12 l12 pb-2">
                                                      <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Cantidad recibida: </label>
                                                      <div class="col l6 m6 s6">
                                                        <input class="validate form-control browser-default" type="text" name="cantidad_recibida" id="cantidad_recibida" >
                                                      </div>
                                                    </div>
                                              </div>

                                                <div class="row">
                                                    <div class="form-group col s12 l12 pb-2">
                                                        <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Unidad: </label>
                                                        <div class="col l6 m6 s6">
                                                          <select class="form-control browser-default" name="unidad" id="unidad">
                                                          </select>
                                                        </div>
                                                      </div>
                                                      <div class="form-group col s12 l12 pb-2">
                                                        <label for="icon_telephone" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Valor total: </label>
                                                        <div class="col l6 m6 s6">
                                                          <input type="text" name="valor_total" id="valor_total" class="validate form-control browser-default">
                                                        </div>
                                                      </div>
                                                      <div class="form-group col s12 l12 pb-2">
                                                          <label for="icon_prefix" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Tipo de moneda: </label>
                                                          <div class="col l6 m6 s6">
                                                            <select class="form-control browser-default" name="tipo_de_moneda" id="tipo_de_moneda">
                                                            </select>
                                                          </div>
                                                      </div>
                                                      <div class="form-group col s12 l12 pb-2" style="display: flex;   justify-content: flex-end;">
                                                        <input type="hidden" name="action" id="action5" value="Editar">
                                                        <div class="col l6 m6 s6">
                                                          <input type="submit" name="action_b5" id="action_b5" class="btn cyan" value="Actualizar">
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
      <!--<div class="card card card-default scrollspy">
        <div class="tab">
          <button class="tablinks" id='openDefault' onclick="openCity(event, 'oneTab')">London</button>
          <button class="tablinks" onclick="openCity(event, 'twoTab')">Paris</button>
          <button class="tablinks" onclick="openCity(event, 'threeTab')">Tokyo</button>
        </div>
        <div id="oneTab" class="tabcontent">
            <h3>London</h3>
            <p>London is the capital city of England.</p>
        </div>
        <div id="twoTab" class="tabcontent">
          <h3>Paris</h3>
          <p>Paris is the capital of France.</p>
        </div>
        <div id='threeTab' class="tabcontent">
          <h3>Tokyo</h3>
          <p>Tokyo is the capital of Japan.</p>
        </div>
      </div>-->
    </div>
  </div>
@endsection
@section('modal')
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Modal Header</h4>
      <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div>
  <div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class=" col s6">
              <h5 class="modal-title">Editar producto</h5>
            </div>
            <div class="col s6" align="right">
              <button type="button" class="modal-action modal-close waves-effect waves-green btn-flat" data-dismiss="modal">&times;</button>
            </div>
          </div>
        </div>

        <div class="modal-body">
          <span id="form_result"></span>
          <form  method="GET" id="sample_form" class="form-horizontal">
            @csrf
            <div class="row container">
                <input type="hidden" name="codigoreal" id="codigoreal" class="form-control" >
                <input type="hidden" name="nro_itemreal" id="nro_itemreal" class="form-control">

                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="icon_prefix">Nro item: </label>
                                          <input type="text" name="nro_item" id="nro_item" class="validate form-control" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="icon_telephone">Cantidad Ingreso:</label>
                                          <input type="text" name="cantidad_ingreso" id="cantidad_ingreso" class="validate form-control" step="1">
                                        </div>
                                  </div>

                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="icon_prefix">Código: </label>
                                          <input type="text" name="codigo" id="codigo" class="validate form-control" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="icon_telephone">Cantidad cierre:</label>
                                          <input type="text" name="cantidad_cierre" id="cantidad_cierre" class="validate form-control" step="1">
                                        </div>
                                  </div>

                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="icon_prefix">Bultos ingreso: </label>
                                          <input type="text" name="bultos_ingreso" id="bultos_ingreso" class="validate form-control" step="1">
                                        </div>

                                  </div>
                                  <div class="row ">
                                        <div class="col s12 l12">
                                        </div>
                                  </div>
                                  <div class="row " align="right">
                                        <div class="col s12 l12">
                                          <input type="hidden" name="action" id="action-producto">
                                          <input type="submit" name="action_button" id="action_button"  class="btn btn-warning" value="Actualizar">
                                        </div>
                                  </div>
            </div>
            <br />
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('after-scripts')
    <script type="text/javascript" src="{{asset('js/tabs.js')}}"></script>
@endsection
