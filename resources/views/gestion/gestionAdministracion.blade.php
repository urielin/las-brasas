@extends('layouts.dashboard')

@section('content')


  <div class="card card card-default scrollspy">
    <div class="row" style="padding:20px">
      <div style="display: flex; justify-content: space-between">
        <div style="display: flex">
          <i class="material-icons dp48">subject</i><span class="card-title">GESTIÓN DE CAMIONES Y CARGA</span>
        </div>
      </div>
        <div class="col s12 l4" style="margin-top: 20px;">
          <div class="row">
              <div class="mb-1 col s12 l12">
                <label for="buscar-codigo">Buscar camión</label>
                <div class="input-group">
                  <input id="codigo" type="text" name="codigo" class="form-control browser-default"  placeholder="Ingrese código camión" style="border-radius:0px">
                  <div class="input-group-append">
                    <button id="buscar-camionad" type="submit" name="actualizar" class="btn btn-50 cyan " style="border-radius: 0px !important; line-height: 45px !important; height:45px !important;width:46px !important">
                      <i class="material-icons dp48">search</i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col s12 l8" style="margin-top: 20px;">
          <div class="row">
            <div class="col s12 l6">
                <label for="clasificacion" >Clasificación</label>
                <select class="form-control browser-default" id="clasificacionad">
                  <option disabled selected value="0">Ingrese la clasificación</option>
                  @foreach ($clasificaciones as $clasificacion)
                  <option value="{{$clasificacion->cod_int}}" >{{$clasificacion->desc01}}</option>
                  @endforeach
                </select>
            </div>
            <div class="col s12 l6">
              <form >
                <label for="estado">Estado </label>
                <select class="form-control browser-default" id="estado">
                  @foreach ($estados as $estado)
                  <option value="{{$estado->CAM_ESTADO}}" >{{$estado->CAM_DESCEST}}</option>
                  @endforeach
                </select>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>


{{-- -------------------------------------------- --}}
  <div class="row">
    <div class="col s12">
      <div class="card card card-default scrollspy" style="padding:20px">
        <div style="display: flex;justify-content: space-between">
            <div style="display: flex;">
              <i class="material-icons dp48">subject</i><span class="card-title">AGREGAR CONTENEDOR</span>
            </div>
            <a class="btn btn-50 green float-right">
              <i class="material-icons" id="agregar-camion">add_box</i>
            </a>
        </div>
          <div class="row pb-4">
                  <div class="col s12">
                    <ul class="tabs">
                      <li class="tab"><a class="active"href="#test1">Camiones</a></li>
                      <li class="tab"><a href="#test2">Detalle del contenedor</a></li>
                      <li class="tab"><a href="#test3">Detalle de items</a></li>
                    </ul>
                  </div>
                  <div id="test1" class="col s12">
                    <div id="responsive-table">
                      <div class="card-content" style=" margin-top: -6px; overflow: auto; height: 60vh;">
                        <div class="row">
                          <div class="col s12 dataTables_scrollBody">
                            <table id="tableAdministrador" class="responsive-table centered">
                              <thead>
                                <tr>
                                  <th>Id</th>
                                  <th>Código</th>
                                  <th>Estado</th>
                                  <th>Código cierre</th>
                                  <th>Descripción</th>
                                  <th>Fecha cierre</th>
                                  <th>Proveedor</th>
                                  <th>Mostrar detalle</th>

                                </tr>
                              </thead>
                              <tbody id="tabla-administracion-cuerpo">


                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="test2" class="col s12" style="padding-top: 20px; padding-left: 40px; padding-right: 40px;">
                    <div class="row">
                        <div class="tab">
                           <div class="tablinks" style="border-top-width: 1px;" id='openDefault' onclick="openCity(event, 'uno2')">Datos generales</div>
                           <div class='tablinks' onclick="openCity(event, 'dos2')">Logística</div>
                           <div class='tablinks' onclick="openCity(event, 'cuatro2')">Datos técnicos</div>
                           <div class='tablinks' onclick="openCity(event, 'cinco2')">Referencias</div>
                        </div>

                        <div id="uno2" class="tabcontent" >
                          <form  method="post" id="actualizar-datosGenerales" class="col s12">
                                    @csrf

                              <div class="row ">
                                <div class="col l12">
                                      {{-- <div class=""> --}}
                                        <div  class="row pt-1 pb-1 pl-1 mb-2" style="background-color:#aaa">
                                              <h7>Información general</h7>
                                        </div>

                                    <div class="row">
                                          <div class="form-group col s12 l12 pb-2">
                                           <label class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Código: </label>
                                           <div class="col l6 m6 s6">
                                             <input  class="form-control browser-default" id="id_codigo_detalle"   name="id_codigo_detalle"  type="hidden" >
                                             <input required class="activo form-control browser-default" id="codigo_detalle"  name="codigo_detalle"  type="text" placeholder="ejm. I19VF20">
                                           </div>
                                         </div>
                                         <div class="form-group col s12 l12 pb-2">
                                           <label for="codigo_aux" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Auxiliar: </label>
                                           <div class="col l6 m6 s6">
                                             <input required class="activo form-control browser-default" name="codigo_aux" id="codigo_aux" type="text" placeholder="ejm. AL-0451">
                                           </div>
                                         </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="estado_detalle" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Estado: </label>
                                              <div class="col l6 m6 s6">
                                                  <select class="activo form-control browser-default" name="estado_detalle" id="estado_detalle" placeholder="PENDIENTES DE PAGO">
                                                    <option disabled selected value="0">Selecciona una opción</option>
                                                    @foreach ($estados as $estado)
                                                    <option value="{{$estado->CAM_ESTADO}}" >{{$estado->CAM_DESCEST}}</option>
                                                    @endforeach
                                                  </select>
                                              </div>
                                          </div>

                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="descripcion" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Descripción: </label>
                                            <div class="col l6 m6 s6">
                                              <input required name="descripcion" id="descripcion" type="text" class="activo browser-default form-control" placeholder="ejm. CARNE AL VACIO">
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="contenido" class="activo form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Cotenido: </label>
                                            <div class="col l6 m6 s6">
                                              <textarea required name="contenido" id="contenido" type="text" class="activo validate form-control browser-default" placeholder="ejm. 24 TON DE CARNE ENVASADA AL VACIO MARCA FRIGOCHACO A US$ 5.300 X TON"> </textarea>
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="observaciones" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Observaciones: </label>
                                            <div class="col l6 m6 s6">
                                              <textarea required name="observaciones" id="observaciones" type="text" class="activo validate form-control browser-default" placeholder="ejm. CIERRE ALMONTI AL-0451 DEL 20/11/2019"></textarea>
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="proveedor" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Proveedor: </label>
                                            <div class="col l6 m6 s6">
                                              <input required name="proveedor" id="proveedor"  type="number" class="activo browser-default form-control" placeholder="ejm. 100">
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="marca_origen" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Marca de origen: </label>
                                              <div class="col l6 m6 s6">
                                                <input required name="marca_origen" id="marca_origen" type="number" class="activo browser-default form-control" placeholder="ejm. 1">
                                              </div>
                                          </div>

                                          <div class="form-group col s12 l12  pb-2">

                                            <label for="clasif_mercancia" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Clasificación: </label>
                                            <div class="col l6 m6 s6">
                                                <select class="activo form-control browser-default" name="clasif_mercancia" id="clasif_mercancia" >
                                                   <option disabled selected value="0">Selecciona una opción</option>
                                                  @foreach ($clasificaciones as $clasificacion)
                                                  <option value="{{$clasificacion->cod_int}}"> {{$clasificacion->desc01}} </option>
                                                  @endforeach
                                                </select>
                                            </div>
                                          </div>
                                      </div>

                                      <div  class="row pt-1 pb-1 pl-1 mb-2" style="background-color:#aaa">
                                            <h7>Información de cierre y forma de pago convenido</h7>
                                      </div>
                                      <div class="row">
                                          <div class="form-group col s12 l12  pb-2">
                                            <label for="fecha_cierre" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha cierre: </label>
                                            <div class="col l6 m6 s6">
                                              <input required name="fecha_cierre" id="fecha_cierre" type="text" class="activo activo browser-default form-control"  placeholder="Ingrese una fecha"  onfocus="(this.type='datetime-local')" onblur="(this.type='text')">
                                            </div>
                                          </div>

                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="cantidad_unidades" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Cantidad cierre: </label>
                                            <div class="col l6 m6 s6">
                                              <input required step="any" name="cantidad_unidades" id="cantidad_unidades" type="number" class="activo browser-default form-control" placeholder="ejm. 24.40">
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="tipo_unidades" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Unidades: </label>
                                            <div class="col l6 m6 s6">
                                              <select class="activo form-control browser-default" name="tipo_unidades" id="tipo_unidades">
                                                <option disabled selected value="0">Selecciona una opción</option>
                                                @foreach ($unidades as $unidad)
                                                <option value="{{$unidad->TUME_CODIGO}}" >{{$unidad->TUME_DESCR}}</option>
                                                @endforeach
                                              </select>
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="monto_unitario" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Unitario: </label>
                                            <div class="col l6 m6 s6">
                                              <input required step="any" name="monto_unitario" id="monto_unitario" type="number"  class="activo browser-default form-control" placeholder="ejm. 24.40">
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="monto_cierre" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Total: </label>
                                            <div class="col l6 m6 s6">
                                              <input required step="any" name="monto_cierre" id="monto_cierre" type="number" class="activo browser-default form-control" placeholder="ejm. 24,000.30">
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="tipo_moneda" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Tipo moneda: </label>
                                            <div class="col l6 m6 s6">
                                              <select class="activo form-control browser-default" name="tipo_moneda" id="tipo_moneda">
                                                <option disabled selected value="0">Selecciona una opción</option>
                                                @foreach ($tipoMonedas as $tipoMoneda)
                                                <option value="{{$tipoMoneda->TMDA_CODIGO}}" >{{$tipoMoneda->TMDA_DESCRIPCION}}</option>
                                                @endforeach
                                              </select>
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="forma_pago" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Forma de pago: </label>
                                            <div class="col l6 m6 s6">
                                              <select class="activo form-control browser-default" name="forma_pago" id="forma_pago">
                                                <option disabled selected value="0">Selecciona una opción</option>
                                                @foreach ($formaPagos as $formaPago)
                                                <option value="{{$formaPago->cod_int}}" >{{$formaPago->desc01}}</option>
                                                @endforeach
                                              </select>
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="despues_dias" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">.: </label>
                                            <div class="col l6 m6 s6">
                                              <select class="activo form-control browser-default" name="despues_dias" id="despues_dias">
                                                <option disabled selected value="0">Selecciona una opción</option>
                                                @foreach ($formaPagosDias as $formaPagosDia)
                                                <option value="{{$formaPagosDia->cod_int}}" >{{$formaPagosDia->desc01}}</option>
                                                @endforeach
                                              </select>
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="despues_fecha" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">..: </label>
                                            <div class="col l6 m6 s6">
                                              <select class="activo form-control browser-default" name="despues_fecha" id="despues_fecha">
                                                <option disabled selected value="0">Selecciona una opción</option>
                                                @foreach ($formaPagosFechas as $formaPagosFecha)
                                                <option value="{{$formaPagosFecha->cod_int}}" >{{$formaPagosFecha->desc01}}</option>
                                                @endforeach
                                              </select>
                                            </div>
                                          </div>

                                        </div>
                                        <div  class="row pt-1 pb-1 pl-1 mb-2" style="background-color:#aaa">
                                              <h7>Información logística de envio de la mercancía</h7>
                                        </div>
                                        <div class="row">

                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="lugar_arribo" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Lugar arribo: </label>
                                            <div class="col l6 m6 s6">
                                                <select class="activo form-control browser-default" name="lugar_arribo" id="lugar_arribo">
                                                  <option disabled selected value="0">Selecciona una opción</option>
                                                  @foreach ($lugarArribos as $lugarArribo)
                                                  <option value="{{$lugarArribo->ciudad_codigo}}" >{{$lugarArribo->descripcion}}</option>
                                                  @endforeach
                                                </select>
                                            </div>
                                          </div>

                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="fecha_embarque1" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha embarque: </label>
                                            <div class="col l6 m6 s6">
                                              <input required name="fecha_embarque1" id="fecha_embarque1" type="text" class="activo browser-default form-control" placeholder="Ingrese una fecha"  onfocus="(this.type='datetime-local')" onblur="(this.type='text')">
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="fecha_embarque2" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Al: </label>
                                            <div class="col l6 m6 s6">
                                              <input required name="fecha_embarque2" id="fecha_embarque2" type="text" class="activo browser-default form-control" placeholder="Ingrese una fecha"  onfocus="(this.type='datetime-local')" onblur="(this.type='text')">
                                            </div>
                                          </div>

                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="fecha_llegada1" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha de llegada: </label>
                                            <div class="col l6 m6 s6">
                                              <input required name="fecha_llegada1" id="fecha_llegada1" type="text" class="activo browser-default form-control" placeholder="Ingrese una fecha"  onfocus="(this.type='datetime-local')" onblur="(this.type='text')">
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="fecha_llegada2" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Al: </label>
                                            <div class="col l6 m6 s6">
                                              <input required name="fecha_llegada2" id="fecha_llegada2" type="text" class="activo browser-default form-control" placeholder="Ingrese una fecha"  onfocus="(this.type='datetime-local')" onblur="(this.type='text')">
                                            </div>
                                          </div>

                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="fecha_produccion" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha de producción: </label>
                                            <div class="col l6 m6 s6">
                                              <input required name="fecha_produccion" id="fecha_produccion" type="text" class="activo browser-default form-control" placeholder="Ingrese una fecha"  onfocus="(this.type='datetime-local')" onblur="(this.type='text')">
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="fecha_produccion2" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Al: </label>
                                            <div class="col l6 m6 s6">
                                              <input required name="fecha_produccion2" id="fecha_produccion2" type="text" class="activo browser-default form-control" placeholder="Ingrese una fecha"  onfocus="(this.type='datetime-local')" onblur="(this.type='text')">
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="fecha_vencimiento" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha de vencimiento: </label>
                                            <div class="col l6 m6 s6">
                                              <input required name="fecha_vencimiento" id="fecha_vencimiento" type="text" class="activo browser-default form-control" placeholder="Ingrese una fecha"  onfocus="(this.type='datetime-local')" onblur="(this.type='text')">
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="fecha_vencimiento2" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Al: </label>
                                            <div class="col l6 m6 s6">
                                              <input required name="fecha_vencimiento2" id="fecha_vencimiento2" type="text" class="activo browser-default form-control" placeholder="Ingrese una fecha"  onfocus="(this.type='datetime-local')" onblur="(this.type='text')">
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 pb-2">
                                            <label for="observacion_fecha" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Observación: </label>
                                            <div class="col l6 m6 s6">
                                              <input required name="observacion_fecha" id="observacion_fecha"  type="text" class="activo browser-default form-control" placeholder="ejm. CARRETERO SAN PEDRO-IQUIQUE">
                                            </div>
                                          </div>
                                          <div class="form-group col s12 l12 " style="display: flex;   justify-content: flex-end;">
                                            <div class="col l6 m6 s6">
                                              <input type="submit" name="action_1" id="action_1" class="accion btn cyan mt-1 float-center" value="Actualizar">
                                            </div>
                                          </div>
                                        </div>
                                      {{-- </div> --}}
                                </div>
                              </div>
                            </form>
                        </div>
                        <div id="dos2" class="tabcontent"  >
                          <form  method="post" id="actualizar-datosLogistica" class="col s12">
                                    @csrf
                          <div  class="row pt-1 pb-1 pl-1 mb-2" style="background-color:#aaa">
                              <h7>Información logistica del contenedor</h7>
                          </div>

                          <div class="row ">
                            <div class="col l12">
                                  {{-- <div class="form-horizontal form-inline"> --}}
                                    <div class="row">
                                      <div class="form-group col s12 l12 pb-2">
                                       <label for="id_logistica" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Id: </label>
                                       <div class="col l6 m6 s6">
                                         <input disabled class="form-control browser-default" name="id_logistica" id="id_logistica" type="text" >
                                         <input required class="form-control browser-default" name="id_codigo_logistica" id="id_codigo_logistica" type="hidden" >
                                       </div>
                                     </div>
                                     <div class="form-group col s12 l12 pb-2">
                                       <label for="codigo_logistica" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Código: </label>
                                       <div class="col l6 m6 s6">
                                         <input disabled class=" form-control browser-default" name="codigo_logistica" id="codigo_logistica" type="text" >
                                       </div>
                                     </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="fecha_cierre_logistica" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha cierre: </label>
                                          <div class="col l6 m6 s6">
                                            <input disabled  name="fecha_cierre_logistica" id="fecha_cierre_logistica" type="datetime-local" class="browser-default form-control">
                                          </div>
                                      </div>

                                    </div>

                                    <div  class="row pt-1 pb-1 pl-1 mb-2" style="background-color:#aaa">
                                        <h7>Ingrese las fechas efectivas segun los datos obtenidos</h7>
                                    </div>



                                    <div class="row">

                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="fecha_embarque" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha embarque: </label>
                                        <div class="col l6 m6 s6">
                                          <input  required name="fecha_embarque" id="fecha_embarque" type="text" class="activo browser-default form-control" placeholder="Ingrese una fecha"  onfocus="(this.type='datetime-local')" onblur="(this.type='text')">
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="fecha_declaracion" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha declaración: </label>
                                        <div class="col l6 m6 s6">
                                          <input required class="activo form-control browser-default" name="fecha_declaracion" type="text" id="fecha_declaracion" placeholder="Ingrese una fecha"  onfocus="(this.type='datetime-local')" onblur="(this.type='text')">
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="fecha_transbordo" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha de transbordo: </label>
                                        <div class="col l6 m6 s6">
                                          <input required name="fecha_transbordo" id="fecha_transbordo" type="text" class="activo validate form-control browser-default" placeholder="Ingrese una fecha"  onfocus="(this.type='datetime-local')" onblur="(this.type='text')">
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="fecha_llegada_estimada" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha llegada a puerto: </label>
                                        <div class="col l6 m6 s6">
                                          <input required name="fecha_llegada_estimada" id="fecha_llegada_estimada"  type="text" class="activo browser-default form-control" placeholder="Ingrese una fecha"  onfocus="(this.type='datetime-local')" onblur="(this.type='text')">
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="fecha_llegada" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha ingreso bodega: </label>
                                          <div class="col l6 m6 s6">
                                            <input required name="fecha_llegada" id="fecha_llegada" type="text" class="activo browser-default form-control" placeholder="Ingrese una fecha"  onfocus="(this.type='datetime-local')" onblur="(this.type='text')">
                                          </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col s12 l12  pb-2">

                                        <label for="fecha_descarga" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha de apertura y descarga: </label>
                                        <div class="col l6 m6 s6">
                                            <input required name="fecha_descarga" id="fecha_descarga" type="text" class="activo browser-default form-control" placeholder="Ingrese una fecha"  onfocus="(this.type='datetime-local')" onblur="(this.type='text')">
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12  pb-2">

                                        <label for="fecha_devolucion_contenedor" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha retorno contenedor: </label>
                                        <div class="col l6 m6 s6">
                                          <input required name="fecha_devolucion_contenedor" id="fecha_devolucion_contenedor" type="text" class="activo browser-default form-control" placeholder="Ingrese una fecha"  onfocus="(this.type='datetime-local')" onblur="(this.type='text')">
                                        </div>
                                      </div>

                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="fecha_cumplimiento" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha cumplimiento documental: </label>
                                        <div class="col l6 m6 s6">
                                          <input required class="activo form-control browser-default" name="fecha_cumplimiento" type="text" id="fecha_cumplimiento" placeholder="Ingrese una fecha"  onfocus="(this.type='datetime-local')" onblur="(this.type='text')">
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="fecha_finalizacion" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha de cierre: </label>
                                        <div class="col l6 m6 s6">
                                          <input required name="fecha_finalizacion" id="fecha_finalizacion" type="text" class="activo browser-default form-control" placeholder="Ingrese una fecha"  onfocus="(this.type='datetime-local')" onblur="(this.type='text')">
                                        </div>
                                      </div>

                                      <div class="form-group col s12 l12 " style="display: flex;   justify-content: flex-end;">
                                        <div class="col l6 m6 s6">
                                          <input type="submit" name="action_2" id="action_2" class="accion accion btn cyan mt-1 float-center" value="Actualizar" >
                                        </div>
                                      </div>
                                    </div>
                                  {{-- </div> --}}
                            </div>
                          </div>
                          </form>
                        </div>
                        <div id="cuatro2" class="tabcontent" >
                          <form  method="post" id="actualizar-datosTecnicos" class="col s12">
                                    @csrf
                          <div class="row ">
                            <div class="col l12">
                                  {{-- <div class="form-horizontal form-inline"> --}}
                                    <div  class="row pt-1 pb-1 pl-1 mb-2" style="background-color:#aaa">
                                        <h7>Empresas relacionadas con el transporte</h7>
                                    </div>

                                    <div class="row">
                                      <div class="form-group col s12 l12 pb-2">
                                       <label for="naviera" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Naviera: </label>
                                       <div class="col l6 m6 s6">
                                         <select class="activo form-control browser-default" name="naviera" id="naviera">
                                           <option  value="0">Selecciona una opción</option>
                                           @foreach ($navieras as $naviera)
                                           <option value="{{$naviera->NAV_CODIGO}}" >{{$naviera->NAV_DETALLE}}</option>
                                           @endforeach
                                         </select>
                                       </div>
                                     </div>
                                     <div class="form-group col s12 l12 pb-2">
                                       <label for="agencia" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Agencia: </label>
                                       <div class="col l6 m6 s6">
                                         <select required class="activo form-control browser-default" name="agencia" id="agencia">
                                           <option  value="0">Selecciona una opción</option>
                                           @foreach ($agencias as $agencia)
                                           <option value="{{$agencia->AGE_CODIGO}}" >{{$agencia->AGE_DETALLE}}</option>
                                           @endforeach
                                         </select>
                                      </div>
                                     </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="transporte_nombre" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Transporte nombre: </label>
                                          <div class="col l6 m6 s6">
                                            <input required name="transporte_nombre" id="transporte_nombre" type="text" class="activo browser-default form-control" placeholder="ejm. 1.2A">
                                            <input name="id_codigo_tecnico" id="id_codigo_tecnico" type="hidden" class="browser-default form-control">
                                          </div>
                                      </div>
                                    </div>

                                    <div  class="row pt-1 pb-1 pl-1 mb-2" style="background-color:#aaa">
                                        <h7>Referencia a documento aduanero</h7>
                                    </div>

                                    <div class="row">
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="ingreso_zeta" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Documento: </label>
                                        <div class="col l6 m6 s6">
                                          <input required name="ingreso_zeta" id="ingreso_zeta" type="number" class="activo browser-default form-control" placeholder="ejm. 023">
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="ingreso_zeta_fecha" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Fecha: </label>
                                        <div class="col l6 m6 s6">
                                          <input required class="activo form-control browser-default" name="ingreso_zeta_fecha" type="datetime-local" id="ingreso_zeta_fecha">

                                        </div>
                                      </div>
                                    </div>

                                      <div  class="row pt-1 pb-1 pl-1 mb-2" style="background-color:#aaa">
                                        <h7>Información para tramitación</h7>
                                      </div>

                                    <div class="row">
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="declara_tramite" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Tipo de tramite: </label>
                                        <div class="col l6 m6 s6">
                                          <select class="activo form-control browser-default" name="declara_tramite" id="declara_tramite">
                                            <option disabled selected value='0'>Selecciona una opción</option>
                                            @foreach ($tramites as $tramite)
                                            <option value="{{$tramite->cod_txt}}" >{{$tramite->desc01}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="declara_origen" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Origen de la mercancia: </label>
                                        <div class="col l6 m6 s6">
                                          <select required class="activo form-control browser-default" name="declara_origen" id="declara_origen">
                                            <option disabled selected value='0'>Selecciona una opción</option>
                                            @foreach ($mercanciaOrigenes as $mercanciaOrigen)
                                            <option value="{{$mercanciaOrigen->cod_txt}}" >{{$mercanciaOrigen->cod_txt}} - {{$mercanciaOrigen->desc01}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="declara_zona_ext" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Zona de franca de extensión: </label>
                                          <div class="col l6 m6 s6">
                                            <select class="activo form-control browser-default" name="declara_zona_ext" id="declara_zona_ext">
                                              <option  value="0">Selecciona una opción</option>
                                              @foreach ($zonasFrancas as $zonasFranca)
                                              <option value="{{$zonasFranca->cod_int}}" >{{$zonasFranca->desc01}}</option>
                                              @endforeach
                                            </select>
                                          </div>
                                      </div>

                                      <div class="form-group col s12 l12  pb-2">

                                        <label for="declara_zona_exp" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Zona franca de exportación: </label>
                                        <div class="col l6 m6 s6">
                                            <select class="activo form-control browser-default" name="declara_zona_exp" id="declara_zona_exp">
                                              <option  value="0">Selecciona una opción</option>
                                              @foreach ($zonasExportaciones as $zonasExportacion)
                                              <option value="{{$zonasExportacion->cod_int}}" >{{$zonasExportacion->desc01}}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12  pb-2">

                                        <label for="declara_zona_franca" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Zona franca: </label>
                                        <div class="col l6 m6 s6">
                                          <select class="activo form-control browser-default" name="declara_zona_franca" id="declara_zona_franca">
                                            <option  value="0">Selecciona una opción</option>
                                            @foreach ($zonaFrancas as $zonaFranca)
                                            <option value="{{$zonaFranca->cod_int}}" >{{$zonaFranca->desc01}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>

                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="declara_region" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Región: </label>
                                        <div class="col l6 m6 s6">
                                          <select class="activo form-control browser-default" name="declara_region" id="declara_region">
                                            <option disabled selected value="0">Selecciona una opción</option>
                                            @foreach ($regiones as $region)
                                            <option value="{{$region->cod_txt}}" >{{$region->desc01}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="declara_tipo_transp" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Medio transporte: </label>
                                        <div class="col l6 m6 s6">
                                          <select class="activo form-control browser-default" name="declara_tipo_transp" id="declara_tipo_transp">
                                            <option  value="0">Selecciona una opción</option>
                                            @foreach ($transportes as $transporte)
                                            <option value="{{$transporte->cod_int}}" >{{$transporte->desc01}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="declara_pais_origen" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Pais de origen: </label>
                                        <div class="col l6 m6 s6">
                                          <input required step="any" name="declara_pais_origen" id="declara_pais_origen" type="number" class="activo browser-default form-control" placeholder="ejm. 563 ">
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="declara_pais_procedencia" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Pais de procedencia: </label>
                                        <div class="col l6 m6 s6">
                                          <input required step="any" name="declara_pais_procedencia" id="declara_pais_procedencia" type="number" class="activo browser-default form-control" placeholder="ejm. 563">
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="declara_puerto_embarque" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Puerto de embarque: </label>
                                        <div class="col l6 m6 s6">
                                          <input required step="any" name="declara_puerto_embarque" id="declara_puerto_embarque" type="number" class="activo browser-default form-control" placeholder="ejm. 563">
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="declara_trasb_ext" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Trans. Extranjero: </label>
                                        <div class="col l6 m6 s6">
                                          <select class="activo form-control browser-default" name="declara_trasb_ext" id="declara_trasb_ext">
                                            <option disabled selected value="0">Selecciona una opción</option>
                                            @foreach ($transExts as $transExt)
                                            <option value="{{$transExt->cod_txt}}" >{{$transExt->desc01}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="declara_trasb_nal" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Trans. Nacional: </label>
                                        <div class="col l6 m6 s6">
                                          <select class="activo form-control browser-default" name="declara_trasb_nal" id="declara_trasb_nal">
                                            <option disabled selected value="0">Selecciona una opción</option>
                                            @foreach ($transNal as $transNa)
                                            <option value="{{$transNa->cod_txt}}" >{{$transNa->desc01}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="declara_almacen" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Almacenista: </label>
                                        <div class="col l6 m6 s6">
                                          <input required name="declara_almacen" id="declara_almacen" type="tex" class="activo browser-default form-control" placeholder="ejm. Nombre del almacenista">
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="declara_almacen_ubic" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Ubicación primaria: </label>
                                        <div class="col l6 m6 s6">
                                          <input required name="declara_almacen_ubic" id="declara_almacen_ubic" type="text" class="activo browser-default form-control" placeholder="ejm. Nombre de ubicación">
                                        </div>
                                      </div>

                                    </div>

                                    <div  class="row pt-1 pb-1 pl-1 mb-2" style="background-color:#aaa">
                                      <h7>Información de valorización</h7>
                                    </div>
                                    <div class="row">

                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="declara_clausula" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Claúsula: </label>
                                        <div class="col l6 m6 s6">
                                          <select class="activo form-control browser-default" name="declara_clausula" id="declara_clausula">
                                            <option disabled selected value="0">Selecciona una opción</option>
                                            @foreach ($clausulas as $clausula)
                                            <option value="{{$clausula->cod_txt}}" >{{$clausula->desc01}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="valor_flete" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">7% de total EXT: </label>
                                        <div class="col l6 m6 s6">
                                          <input required  step="any" name="valor_flete" id="valor_flete" type="number" class="activo browser-default form-control" placeholder="ejm. 7%">
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="valor_seguro" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">2% de total EXT: </label>
                                        <div class="col l6 m6 s6">
                                          <input  step="any" required name="valor_seguro" id="valor_seguro" type="number" class="activo browser-default form-control" placeholder="ejm. 7%">
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="valor_fob" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">FOB(Flete + seguro)- Total EXT: </label>
                                        <div class="col l6 m6 s6">
                                          <input required  step="any" name="valor_fob" id="valor_fob" type="number" class="activo browser-default form-control" placeholder="ejm. 137400,0000">
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="valor_total" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Total $(EXT): </label>
                                        <div class="col l6 m6 s6">
                                          <input required  step="any" name="valor_total" id="valor_total" type="number" class="activo browser-default form-control" placeholder="ejm. 137,0000">
                                        </div>
                                      </div>
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="valor_total_nal" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Valor $(NAL): </label>
                                        <div class="col l6 m6 s6">
                                          <input required  step="any" name="valor_total_nal" id="valor_total_nal" type="number" class="activo browser-default form-control" placeholder="ejm. 137,0000">
                                        </div>
                                      </div>

                                      </div>
                                      <div  class="row pt-1 pb-1 pl-1 mb-2" style="background-color:#aaa">
                                        <h7>Destino de la mercancía</h7>
                                      </div>
                                      <div class="row">
                                      <div class="form-group col s12 l12 pb-2">
                                        <label for="sucursal" class="form-control-label col l6 m6 s6" style="text-align: right;display: inline-block;">Ubicación destino: </label>
                                        <div class="col l6 m6 s6">
                                          <select class="activo form-control browser-default" name="sucursal" id="sucursal">
                                          <option  value="0">Selecciona una opción</option>
                                            @foreach ($sucursales as $sucursal)
                                            <option value="{{$sucursal->SUCU_CODIGO}}" >{{$sucursal->SUCU_NOMBRE}} ( {{$sucursal->SUCU_UBICACION}})</option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>

                                      <div class="form-group col s12 l12 " style="display: flex;   justify-content: flex-end;">
                                        <div class="col l6 m6 s6">
                                          <input  type="submit" name="action_3" id="action_3" class="accion btn cyan mt-1 float-center" value="Actualizar">
                                        </div>
                                      </div>
                                    </div>
                                  {{-- </div> --}}
                            </div>
                          </div>
                          </form>
                        </div>
                        <div id="cinco2" class="tabcontent"  style="padding-top:20px">
                              <div id="responsive-table" class=" ">
                                <div class="card-content" style=" margin-top: -6px; overflow: auto;  ">
                                  <h4 class="card-title"></h4>
                                  <p class="mb-2"></p>
                                  <div class="row">
                                    <div class="col s12">
                                    </div>
                                    <div class="col s12 dataTables_scrollBody">
                                      <table id="tabla-camionesAutorizacionDetalle">
                                        <thead>
                                        <tr>
                                          <th>Certificado</th>
                                          <th>Organismo</th>
                                          <th>Tipo</th>
                                          <th>Número</th>
                                          <th>Fecha</th>
                                          <th>Glosa</th>
                                          <th>Usuario</th>
                                          <th>Fecha</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tabla-camionesAutorizacionDetalle-body">

                                        </tbody>
                                      </table>
                                 </div>
                                </div>
                               </div>
                              </div>
                              <br>

                              <div id="responsive-table" class=" ">
                                <div class="card-content" style=" margin-top: -6px; overflow: auto;  ">
                                  <h4 class="card-title"></h4>
                                  <p class="mb-2"></p>
                                  <div class="row">
                                    <div class="col s12">
                                    </div>
                                    <div class="col s12 dataTables_scrollBody">
                                          <table id="tabla-camionesAdjuntoDetalle">
                                            <thead>
                                            <tr>
                                              <th>Tipo</th>
                                              <th>Número documento</th>
                                              <th>Fecha documento</th>
                                              <th>Nombre emisor</th>
                                              <th>Número</th>
                                              <th>Usuario</th>
                                              <th>Fecha</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tabla-camionesAdjuntoDetalle-body">

                                            </tbody>
                                          </table>
                                        </div>
                                       </div>
                                      </div>
                                     </div>

                              <br>

                              <div id="responsive-table" class=" ">
                                <div class="card-content" style=" margin-top: -6px; overflow: auto;  ">
                                  <h4 class="card-title"></h4>
                                  <p class="mb-2"></p>
                                  <div class="row">
                                    <div class="col s12">
                                    </div>
                                    <div class="col s12 dataTables_scrollBody">
                                        <table id="tabla-camionesBultoDetalle">
                                          <thead>
                                          <tr>
                                            <th>Tipo</th>
                                            <th>Cantidad</th>
                                            <th>Peso bruto</th>
                                            <th>Descripción</th>
                                            <th>Usuario</th>
                                            <th>Fecha</th>
                                          </tr>
                                          </thead>
                                          <tbody id="tabla-camionesBultoDetalle-body">

                                          </tbody >
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              <br>

                              <div id="responsive-table" class=" ">
                                <div class="card-content" style=" margin-top: -6px; overflow: auto;  ">
                                  <h4 class="card-title"></h4>
                                  <p class="mb-2"></p>
                                  <div class="row">
                                    <div class="col s12">
                                    </div>
                                    <div class="col s12 dataTables_scrollBody">
                                        <table id="camionesContenedorDetalle">
                                          <thead>
                                          <tr>
                                            <th>Tipo</th>
                                            <th>Contenedor/camión</th>
                                            <th>Observaciones</th>
                                            <th>Usuario</th>
                                            <th>Fecha</th>
                                          </tr>
                                          </thead>
                                          <tbody id="tabla-camionesContenedorDetalle-body">

                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                        </div>
                      </div>
                  </div>
                  <div id="test3" class="col s12">
                    <div id="responsive-table" class=" ">
                      <div class="card-content" style=" margin-top: -6px; overflow: auto;  ">
                        <h4 class="card-title"></h4>
                        <p class="mb-2"></p>
                        <div class="row">
                          <div class="col s12">
                          </div>
                          <div class="col s12 dataTables_scrollBody">
                              <table id="itemsContenedorDetalle" class="centered">
                                <thead>
                                <tr>
                                  <th>Nº item</th>
                                  <th>Nombre</th>
                                  <th>Código</th>
                                  <th>Producto</th>
                                </tr>
                                </thead>
                                <tbody id="tabla-itemsContenedorDetalle-body">

                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
              </div>
          </div>
      </div>
    </div>
  </div>
{{-- -------------------------------------------- --}}
@endsection

@section('js')
  <script src="{{ asset('js/gestionAdministracion.js') }}"></script>
@endsection

@section('modal')

  <div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class=" col s6 pb-2">
              <h5 class="modal-title">Agregar nuevo contenedor</h5>
            </div>
            <div class="col s6" align="right">
              <button type="button" class="modal-action modal-close waves-effect waves-green btn-flat" data-dismiss="modal">&times;</button>
            </div>
          </div>
        </div>

        <div class="modal-body">
          <span id="form_result"></span>
          <form  method="POST" id="nuevo-camion" class="form-horizontal">
            @csrf
            <div class="row container">
                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="codigo_agregar">Código: </label>
                                          <input required type="text" name="codigo_agregar" id="codigo_agregar" placeholder="ejm. I19VF20" class="validate form-control" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="auxiliar_agregar">Auxiliar:</label>
                                          <input required type="text" name="auxiliar_agregar" id="auxiliar_agregar" placeholder="ejm. AL-0451" class="validate form-control" step="1">
                                        </div>
                                  </div>

                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="descripcion_agregar">Descripción: </label>
                                          <input required type="text" name="descripcion_agregar" id="descripcion_agregar" placeholder="ejm. CARNE AL VACIO" class="validate form-control" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="contenido_agregar">Contenido:</label>
                                          <input required type="text" name="contenido_agregar" id="contenido_agregar" placeholder="ejm. 24 TON DE CARNE ENVASADA AL VACIO MARCA FRIGOCHACO A US$ 5.300 X TON" class="validate form-control" step="1">
                                        </div>
                                  </div>
                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="documento_agregar">Documento: </label>
                                          <input required type="text" name="documento_agregar"  id="documento_agregar" placeholder="ejm. 003-15-000006" class="validate form-control" step="1">
                                        </div>
                                        <div class="col s12 l6">
                                          <label for="fecha_agregar">Fecha documento:</label>
                                          <input required type="text" name="fecha_agregar"  id="fecha_agregar" placeholder="Ingrese una fecha"  onfocus="(this.type='datetime-local')" onblur="(this.type='text')" class="validate form-control" step="1">
                                        </div>
                                  </div>

                                  <div class="row pb-2">
                                        <div class="col s12 l6">
                                          <label for="observaciones_agregar">Observaciones: </label>
                                          <input required type="text" name="observaciones_agregar" id="observaciones_agregar" placeholder="ejm. CARRETERO SAN PEDRO-IQUIQUE" class="validate form-control" step="1">
                                        </div>

                                  </div>
                                  <div class="row ">
                                        <div class="col s12 l12">
                                        </div>
                                  </div>
                                  <div class="row " align="right">
                                        <div class="col s12 l12">
                                          <input type="submit" name="action_button" id="action_enviar"  class="btn btn-warning" value="Agregar">
                                        </div>
                                  </div>
             </div>
            <br />
          </form>
        </div>
      </div>
    </div>
  </div>

  <div id="formModal2" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <div class="row">
            <div class=" col s6 pb-2">
              <h5 class="modal-title">Detalle general</h5>
            </div>
            <div class="col s6" align="right">
              <button type="button" class="modal-action modal-close waves-effect waves-green btn-flat" data-dismiss="modal">&times;</button>
            </div>
          </div>
        </div>

        <div class="modal-body">
          <span id="form_result"></span>

            <div class="row container">
              <div class="row pb-2">
                <div class="col s12 l6">
                  <label for="monto_cierred">Monto cierre: </label>
                  <input disabled type="text" name="monto_cierred" id="monto_cierred"  class="validate form-control" step="1">
                </div>
                <div class="col s12 l6">
                  <label for="tipo_monedad">Moneda:</label>
                  <input disabled type="text" name="tipo_monedad" id="tipo_monedad"  class="validate form-control" step="1">
                </div>
              </div>

              <div class="row pb-2">
                <div class="col s12 l6">
                  <label for="fecha_embarqued">embarque: </label>
                  <input disabled type="text" name="fecha_embarqued" id="fecha_embarqued"  class="validate form-control" step="1">
                </div>
                <div class="col s12 l6">
                  <label for="fecha_llegada_estimadad">Llegada estimada:</label>
                  <input disabled type="text" name="fecha_llegada_estimadad" id="fecha_llegada_estimadad"  class="validate form-control" step="1">
                </div>
              </div>
              <div class="row pb-2">
                <div class="col s12 l6">
                  <label for="lugar_arribod">Lugar llegada: </label>
                  <input disabled type="text" name="lugar_arribod"  id="lugar_arribod" class="validate form-control" step="1">
                </div>
                <div class="col s12 l6">
                  <label for="declara_origend">Origen: </label>
                  <input disabled type="text" name="declara_origend"  id="declara_origend"  class="validate form-control" step="1">
                </div>
              </div>

              <div class="row pb-2">
                <div class="col s12 l6">
                  <label for="ingreso_zetad">Documento: </label>
                  <input disabled type="text" name="ingreso_zetad"  id="ingreso_zetad" class="validate form-control" step="1">
                </div>
                <div class="col s12 l6">
                  <label for="navierad">Empresa transporte: </label>
                  <input disabled type="text" name="navierad"  id="navierad" class="validate form-control" step="1">
                </div>
              </div>
             </div>
            <br />

        </div>
      </div>
    </div>
  </div>

  {{-- --------------------------------------------------- --}}

@endsection

@section('after-scripts')
    <script type="text/javascript" src="{{asset('js/tabs.js')}}"></script>
@endsection
