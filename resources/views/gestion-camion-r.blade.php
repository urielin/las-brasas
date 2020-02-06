@extends('layouts.dashboard')

@section('content')

  <div class="main-content">
    <div class="bg-gradient-primary container-fluid pb-7 pt-3">
      <p class="h1 my-3 text-white text-uppercase d-lg-inline-block" >Contenedores / Camiones - RECEPCIONADOS</p>

        <br><br>

      <div class="row ">
            <div class="col-4 bg-gradient-secondary border ml-3 mr-1 pt-3 card">
              <div class="form-group">
                {{-- {!! Form::open(['route' => ['showCamion-r'],'class' => 'text-center', 'method' => 'get', 'enctype' => 'multipart/form-data'])!!} --}}
                <form  method="post" id="buscar-camion" class="form-horizontal">
                    @csrf
                    <label for="buscar-codigo-camion">Buscar camión</label>

                    <input type="text" name="codigo" class="form-control" id="buscar-codigo-camion" placeholder="Ingrese código camión">
                    <input type="hidden" name="action" id="action-buscar-camion"  value="buscar-camion-r">
                    {{-- <input type="text" name="codigo_id" class="form-control" id="buscar-codigo-camion" placeholder="Ingrese código camión"> --}}
                    {{-- <input type="text" name="bultos_ingreso" id="bultos_ingreso" class="form-control"> --}}
                    {{-- <br> --}}
                    <button type="submit" name="actualizar" class="btn btn-primary mt-1 float-right">Buscar</button>
                </form>
                {{-- {!! Form::close()!!} --}}
              </div>
            </div>

      <div class="col-7 bg-gradient-secondary border card pt-3">
        <div class="row">
          <div class="form-group col-3">
            <label for="anior">Ingresar año</label>

            <select class="form-control" id="anior">
              <option>Año</option>
              @foreach ($year as $y)

                <option value="{{$y->TP_GESTION}}" >{{$y->TP_GESTION}}</option>

              @endforeach
            </select>
          </div>

          <div class="form-group col-4">
            <label for="clasificacionr">Clasificar camión </label>
            <select class="form-control" id="clasificacionr">
              {{-- @foreach ($clasificaciones as $clasificacion)

                <option value="{{$clasificacion->desc01}}" >{{$clasificacion->desc01}}</option>

              @endforeach --}}
            </select>
          </div>

          <div class="form-group col-5">
            <input type="hidden" name="action" id="icamion"  value="camion-r">
            <label for="camionr">Seleccionar camión </label>
            <select class="form-control"  id="camion">

            </select>
          </div>

          </div>
        </div>
      </div>

      <hr>



      <div class="row">
          <div class="col-md-12">


              <!-- Tabs with icons on Card -->
              <div class="card card-nav-tabs ">
                  <div class="card-header card-header-primary">
                      <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                      <div class="nav-tabs-navigation ">
                          <div class="nav-tabs-wrapper">
                              <ul class="nav nav-tabs" data-tabs="tabs">
                                  <li class="nav-item">
                                      <a class="nav-link active " href="#profile" data-toggle="tab">
                                          <i style=" font-style: normal; " class="material-icons">Detalle</i>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#messages" data-toggle="tab">
                                          <i style=" font-style: normal; " class="material-icons">Actualizar camión</i>
                                      </a>
                                  </li>
                                  <div class="row ">
                                      <div class="col-12 float-right">
                                        <li class="nav-item">

                                            <span id="bloquear-camion"></span>

                                        </li>
                                      </div>
                                  </div>
                              </ul>
                          </div>
                      </div>
                  </div>
                  <div class="card-body pt-0 ">
                      <div class="tab-content text-center">
                          <div class="tab-pane active" id="profile">

                            {{-- <div class="table">
                              <thead>
                                <tr>

                            </div> --}}
                            <div class="row">
                              <div class="table-responsive table-hover">
                                <table  class="table align-items-left table-flush">
                                  <thead id="camiontabla-head" class="thead-light">

                                  </thead>
                                  <tbody id="camiontabla">
                                    {{-- JavaScript --}}

                                  </tbody>
                                </table>
                              </div>
                            </div>

                          </div>

                      <div class="tab-pane" id="messages">

                        <nav>
                          <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#uno" role="tab" aria-controls="nav-home" aria-selected="true">Datos de camión</a>
                          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#dos" role="tab" aria-controls="nav-profile" aria-selected="false">Fecha embarque y llegada</a>
                          {{-- <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#tres" role="tab" aria-controls="nav-contact" aria-selected="false">Forma de pago</a> --}}
                          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#cuatro" role="tab" aria-controls="nav-profile" aria-selected="false">Datos embarque y llegada</a>
                          <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#cinco" role="tab" aria-controls="nav-contact" aria-selected="false">Valor total del camion</a>
                          </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                          <div class="tab-pane fade show active" id="uno" role="tabpanel" aria-labelledby="nav-home-tab">
                                  @php if ($datos != '[]') { @endphp @php } else { @endphp
                                        <br/>
                                          <span id="form_result_consulta1"></span>
                                          <form  method="POST"  class="form-horizontal">
                                          @csrf

                                                <div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-2 col-form-label">Código oficial</label>
                                                  <div class="col-sm-3">
                                                    <input class="form-control form-control-sm" name="codigo_oficial" id="codigo_oficial" type="text" >
                                                    <input type="hidden" class="form-control form-control-sm" name="codigo_oficial_real" id="codigo_oficial_real" type="text" >
                                                  </div>
                                                  <label for="inputPassword" class="col-sm-2 col-form-label">Código auxiliar</label>
                                                  <div class="col-sm-3">
                                                    <input class="form-control form-control-sm" name="codigo_auxiliar" id="codigo_auxiliar" type="text" >
                                                  </div>

                                                </div>

                                                <div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-2 col-form-label">Nro de contenedor</label>
                                                  <div class="col-sm-3">
                                                    <input class="form-control form-control-sm"  name="nro_de_contenedor" id="nro_de_contenedor" type="text" >
                                                  </div>
                                                  <label for="inputPassword" class="col-sm-2 col-form-label">Nro BL</label>
                                                  <div class="col-sm-3">
                                                    <input class="form-control form-control-sm" name="nro_bl" id="nro_bl" type="text" >
                                                  </div>
                                                </div>

                                                <div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-2 col-form-label">Clasificación de mercancía</label>
                                                  <div class="col-sm-6">
                                                    <select class=" form-control" name="clasificacion_de_mercancia" id="clasificacion_de_mercancia">
                                                       // <option>Mercacías</option>
                                                    </select>
                                                  </div>
                                                </div>

                                                <div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-2 col-form-label">Proveedor</label>
                                                  <div class="col-sm-6">
                                                    <select class=" form-control" name="proveedor" id="proveedor">
                                                       // <option>Proveedor</option>
                                                    </select>
                                                  </div>
                                                </div>

                                                <div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-2 col-form-label">Marca origen</label>
                                                  <div class="col-sm-3">
                                                  <select class=" form-control" name="marca_origen" id="marca_origen">

                                                  </select>
                                                  </div>
                                                  <label for="inputPassword" class="col-sm-2 col-form-label">Pais origen</label>
                                                  <div class="col-sm-3">
                                                    <input class="form-control form-control-sm" name="pais_origen" id="pais_origen" type="text" >
                                                  </div>
                                                </div>

                                                <div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-2 col-form-label">Descripción</label>
                                                  <div class="col-sm-6">
                                                    <input class="form-control form-control-sm" name="descripcion" id="descripcion" type="text" >
                                                  </div>
                                                </div>

                                                <div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-2 col-form-label">Contenido</label>
                                                  <div class="col-sm-6">
                                                    <textarea class="form-control form-control-sm" name="contenido" id="contenido" type="text"></textarea>
                                                  </div>
                                                </div>

                                                <div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-2 col-form-label">Observaciones</label>
                                                  <div class="col-sm-6">
                                                    <input class="form-control form-control-sm" name="observaciones" id="observaciones" type="text" >
                                                  </div>
                                                </div>

                                                <div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-2 col-form-label">Lugar de arribo</label>
                                                  <div class="col-sm-6">
                                                    <select class=" form-control" name="lugar_de_arribo" id="lugar_de_arribo">

                                                    </select>
                                                  </div>
                                                </div>

                                                <br />
                                                <div class="form-group" align="center">
                                                  <span id="bandera-general"></span>

                                                  <input type="hidden" name="ac"  value="">

                                                </div>

                                          </form>
                                    @php } @endphp
                                  </div>
                          <div class="tab-pane fade" id="dos" role="tabpanel" aria-labelledby="nav-profile-tab">
                            @php if ($datos != '[]') { @endphp @php } else { @endphp
                                  <br/>
                                  <span id="form_result_consulta2"></span>
                                <form  method="post"  class="form-horizontal">
                                  @csrf

                                      <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Fecha de cierre</label>
                                        <div class="col-sm-6">
                                          <input class="form-control form-control-sm" name="fecha_de_cierre" id="fecha_de_cierre" type="text" >
                                          <input type="hidden" class="form-control form-control-sm" name="codigo_oficial_real2" id="codigo_oficial_real2" type="text" >
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Fecha de embarque desde</label>
                                        <div class="col-sm-3">
                                          <input class="form-control form-control-sm" name="fecha_de_embarque_desde" id="fecha_de_embarque_desde" type="text" >
                                        </div>
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Hasta</label>
                                        <div class="col-sm-3">
                                          <input class="form-control form-control-sm" name="fecha_de_embarque_desde_hasta" id="fecha_de_embarque_desde_hasta" type="text" >
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Fecha de llegada desde</label>
                                        <div class="col-sm-3">
                                          <input class="form-control form-control-sm" type="text" name="fecha_de_llegada_desde" id="fecha_de_llegada_desde">
                                        </div>
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Hasta</label>
                                        <div class="col-sm-3">
                                          <input class="form-control form-control-sm" type="text" name="fecha_de_llegada_desde_hasta" id="fecha_de_llegada_desde_hasta">
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Observación</label>
                                        <div class="col-sm-6">
                                          <input class="form-control form-control-sm"  type="text" name="observacion" id="observacion">
                                        </div>
                                      </div>


                                      <br />
                                      <div class="form-group" align="center">
                                      </div>
                                </form>
                             @php } @endphp
                          </div>
                          <div class="tab-pane fade" id="tres" role="tabpanel" aria-labelledby="nav-contact-tab">

                            @php
                              if ($datos != '[]') { @endphp @php } else { @endphp

                                  <br/>
                                <form  method="post"  class="form-horizontal">
                                @csrf

                                    <div class="form-group row">
                                      <label for="staticEmail" class="col-sm-2 col-form-label">Forma de pago</label>
                                      <div class="col-sm-6">
                                        <select class=" form-control" name="forma_de_pago" id="forma_de_pago">
                                           <option>Forma de pago</option>
                                        </select>
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                      <label for="staticEmail" class="col-sm-2 col-form-label">A cumplirse a</label>
                                      <div class="col-sm-6">
                                        <select class=" form-control" id="a_cumplirse_a">

                                        </select>
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                      <label for="staticEmail" class="col-sm-2 col-form-label">-</label>
                                      <div class="col-sm-6">
                                        <select class=" form-control" id="a_cumplirse_a-">
                                           <option>-</option>
                                        </select>
                                      </div>
                                    </div>

                                  <br />
                                  <div class="form-group" align="center">
                                  </div>
                              </form>
                           @php } @endphp
                          </div>
                          <div class="tab-pane fade" id="cuatro" role="tabpanel" aria-labelledby="nav-home-tab">
                              {{-- ---------------------------- --}}
                              {{-- @foreach ($datos as $item) --}}

                                  @php
                                    if ($datos != '[]') {
                                  @endphp

                                  @php
                                    }
                                    else {

                                  @endphp
                                        <br/>
                                        <span id="form_result_consulta4"></span>
                                        <form  method="post"  class="form-horizontal">
                                          @csrf

                                                <div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-2 col-form-label">Fecha de embarque real </label>
                                                  <div class="col-sm-6">
                                                    <input class="form-control form-control-sm" name="fecha_de_embarque_real" id="fecha_de_embarque_real" type="text" >
                                                    <input type="hidden" class="form-control form-control-sm" name="codigo_oficial_real4" id="codigo_oficial_real4" type="text" >
                                                  </div>
                                                </div>

                                                <div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-2 col-form-label">Fecha de llegada </label>
                                                  <div class="col-sm-6">
                                                    <input class="form-control form-control-sm" name="fecha_de_llegada" id="fecha_de_llegada" type="text">
                                                  </div>
                                                </div>

                                                <div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-2 col-form-label">Resol. Sanitaria</label>
                                                  <div class="col-sm-3">
                                                    <input class="form-control form-control-sm" name="resol_sanitaria" type="text" id="resol_sanitaria">
                                                  </div>
                                                  <label for="inputPassword" class="col-sm-2 col-form-label">Fecha de Resol. Sanitaria</label>
                                                  <div class="col-sm-3">
                                                    <input class="form-control form-control-sm" name="fecha_de_resol_sanitaria" type="text" id="fecha_de_resol_sanitaria">
                                                  </div>
                                                </div>

                                                <div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-2 col-form-label">Forward</label>
                                                  <div class="col-sm-3">
                                                    <input class="form-control form-control-sm" name="forward" type="text" id="forward">
                                                  </div>
                                                  <label for="inputPassword" class="col-sm-2 col-form-label">Fecha Forward</label>
                                                  <div class="col-sm-3">
                                                    <input class="form-control form-control-sm" name="fecha_forward" type="text" id="fecha_forward">
                                                  </div>
                                                </div>

                                                <div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-2 col-form-label">Fecha producción desde</label>
                                                  <div class="col-sm-3">
                                                    <input class="form-control form-control-sm" type="text" name="fecha_producción_desde" id="fecha_producción_desde">
                                                  </div>
                                                  <label for="inputPassword" class="col-sm-2 col-form-label">Hasta</label>
                                                  <div class="col-sm-3">
                                                    <input class="form-control form-control-sm" type="text" name="fecha_producción_desde_hasta" id="fecha_producción_desde_hasta">
                                                  </div>
                                                </div>

                                                <div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-2 col-form-label">Fecha vencimiento desde</label>
                                                  <div class="col-sm-3">
                                                    <input class="form-control form-control-sm" type="text" name="fecha_vencimiento_desde" id="fecha_vencimiento_desde">
                                                  </div>
                                                  <label for="inputPassword" class="col-sm-2 col-form-label">Hasta</label>
                                                  <div class="col-sm-3">
                                                    <input class="form-control form-control-sm" type="text" name="fecha_vencimiento_desde_hasta" id="fecha_vencimiento_desde_hasta">
                                                  </div>
                                                </div>

                                                <br />
                                                <div class="form-group" align="center">

                                                </div>

                                          </form>
                                    @php
                                    }
                                    @endphp
                                {{-- @endforeach --}}

                              {{-- ---------------------------- --}}
                          </div>
                          <div class="tab-pane fade" id="cinco" role="tabpanel" aria-labelledby="nav-home-tab">

                                  @php if ($datos != '[]') { @endphp @php } else { @endphp
                                        <br/>
                                          <span id="form_result_consulta5"></span>
                                          <form  method="post"  class="form-horizontal">
                                          @csrf

                                                <div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-2 col-form-label">Factura proveedor</label>
                                                  <div class="col-sm-6">
                                                    <input class="form-control form-control-sm" type="text" name="factura_proveedor" id="factura_proveedor" >
                                                    <input class="form-control form-control-sm" name="codigo_oficial_real5" id="codigo_oficial_real5" type="hidden" >
                                                  </div>
                                                </div>

                                                <div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-2 col-form-label">Cantidad recibida</label>
                                                  <div class="col-sm-3">
                                                    <input class="form-control form-control-sm" type="text" name="cantidad_recibida" id="cantidad_recibida">
                                                  </div>
                                                  <label for="inputPassword" class="col-sm-2 col-form-label">Unidad</label>
                                                  <div class="col-sm-3">
                                                    <select class=" form-control" name="unidad" id="unidad">

                                                    </select>
                                                  </div>
                                                </div>

                                                <div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-2 col-form-label">Valor total</label>
                                                  <div class="col-sm-6">
                                                    <input class="form-control form-control-sm" type="text" name="valor_total" id="valor_total">
                                                  </div>
                                                </div>

                                                <div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-2 col-form-label">Tipo de moneda</label>
                                                  <div class="col-sm-6">
                                                    <select class=" form-control" name="tipo_de_moneda" id="tipo_de_moneda">

                                                    </select>
                                                  </div>
                                                </div>



                                                <br />
                                                <div class="form-group" align="center">

                                                </div>

                                          </form>
                                    @php } @endphp

                                </div>
                        </div>


                      </div>

                      <div class="tab-pane" id="messages2">

                        <div class="row">
                          <div class="table-responsive  table-hover">
                            <table  class="table align-items-center table-flush">
                              <thead class="thead-light">
                                <tr>
                                  <th scope="col">Fecha</th>
                                  <th scope="col">Cambio</th>
                                  <th scope="col">USUARIO</th>
                                </tr>
                              </thead>
                              <tbody>

                                <tr>
                                  <td>
                                    G
                                  </td>
                                  <td>
                                    H
                                  </td>
                                  <td>
                                    I
                                  </td>
                                </tr>

                              </tbody>
                            </table>
                          </div>
                        </div>

                  </div>


                  </div>
                </div>
              <!-- End Tabs with icons on Card -->

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
            <form  method="post" id="sample_form" class="form-horizontal">
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
