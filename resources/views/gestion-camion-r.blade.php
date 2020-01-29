@extends('layouts.dashboard')

@section('content')

  <div class="main-content">
    <div class="bg-gradient-primary container-fluid pb-7 pt-3">
      <p class="h1 my-3 text-white text-uppercase d-lg-inline-block" >Contenedores / Camiones - RECEPCIONADOS</p>

        <br><br>

      <div class="row ">
            <div class="col-4 bg-gradient-secondary border ml-3 mr-1 pt-3 card">
              <div class="form-group">
                {!! Form::open(['route' => ['showCamion-r'],'class' => 'text-center', 'method' => 'get', 'enctype' => 'multipart/form-data'])!!}
                @csrf
                <label for="buscar-codigo-camion">Buscar camión</label>
                <input type="text" name="codigo" class="form-control" id="buscar-codigo-camion" placeholder="Ingrese código camión">
                {{-- <br> --}}
                <button type="submit" name="actualizar" class="btn btn-primary mt-1 float-right">Buscar</button>
                {!! Form::close()!!}
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
            <label for="camionr">Seleccionar camión </label>
            <select class="form-control" id="camionr">

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
                                  {{-- <li class="nav-item">
                                      <a class="nav-link" href="#messages2" data-toggle="tab">
                                          <i style=" font-style: normal; " class="material-icons">Actualizar camion</i>
                                      </a>
                                  </li> --}}
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
                                  <thead class="thead-light">
                                    <tr>
                                      <th scope="col">Bloqueo</th>
                                      <th scope="col">Acción</th>
                                      <th scope="col">Nro</th>
                                      <th scope="col">Cod.</th>
                                      <th scope="col">Producto</th>
                                      <th scope="col">Cantidad cierre</th>
                                      <th scope="col">Bultos ingreso</th>
                                      <th scope="col">Cantidad ingreso</th>
                                      <th scope="col">(+/-)</th>
                                      <th scope="col">C.I.F</th>
                                      <th scope="col">V.I.U</th>
                                      <th scope="col">C.I.F(MN)</th>
                                      <th scope="col">Precio_Compra(MN)</th>
                                      <th scope="col">Total factura</th>
                                      <th scope="col">Gastos(MN)</th>
                                      <th scope="col">CIF tierra(MN)</th>
                                      <th scope="col">Total_Costo_Final</th>

                                  </thead>
                                  <tbody id="camiontabla">
                                    {{-- <tr><td>asdasd</td></tr> --}}
                                @php
                                $bi=0;$ci=0;$mm=0;$tf=0;$tcf=0;
                                @endphp

                                {{-- // value.cantidad_diferencia --}}
                                {{-- // value.total_compra --}}


                                  @foreach ($datos as $item)
                                    <tr >
                                      @php
                                        if ($item->bloqueo_2 == '1') {
                                          @endphp
                                          <td>
                                          <label class="custom-toggle custom-toggle-default">
                                            <input type="checkbox" checked  class="btn-switch">
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span>
                                          </label>
                                          </td>
                                          @php
                                        }
                                        else {
                                          @endphp
                                          <td>
                                          <label class="custom-toggle custom-toggle-default">
                                            <input type="checkbox"  class="btn-switch">
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span>
                                          </label>
                                          </td>
                                          @php
                                        }
                                      @endphp
                                      <td>

                                        <button type="button" value="{{$item->nro_item}}" class="editar-gestion btn btn-warning btn-sm">Editar</button>

                                      <td>{{$item->nro_item}}</td>
                                      <td>{{$item->codigo}}</td>
                                      <td>{{$item->producto}}</td>
                                      <td>{{$item->cantidad_cierre}}</td>
                                      <td>{{$item->bultos_ingreso}}</td>
                                      <td>{{$item->cantidad_ingreso}}</td>
                                      <td>{{$item->cantidad_diferencia}}</td>
                                      <td>{{$item->cif_moneda_ext}}</td>
                                      <td>{{$item->viu_moneda_nal}}</td>
                                      <td>{{$item->cif_moneda_nal}}</td>
                                      <td>{{$item->precio_compra}}</td>
                                      <td>{{$item->total_compra}}</td>
                                      <td>{{$item->cif_adicional_nal}}</td>
                                      <td>{{$item->cif_final_nal}}</td>
                                      <td>{{$item->total_costo}}</td>
                                    </tr>
                                    @php
                                      $bi+=$item->bultos_ingreso;
                                      $ci+=$item->cantidad_ingreso;
                                      $mm+=$item->cantidad_diferencia;
                                      $tf+=$item->total_compra;
                                      $tcf+=$item->total_costo;
                                    @endphp
                                      {{-- F-bultos_ingresos F-cantidad_ingresos{{$item->cantidad_diferencia}}{{$item->total_compra}}{{$item->total_costo}} --}}
                                  @endforeach

                                  <tr >
                                    <td>

                                    </td>
                                    <td>
                                      {{-- {{$item->nro_item}} --}}
                                    </td>
                                    <td>
                                      {{-- {{$item->codigo}} --}}
                                    </td>
                                    <td>
                                      {{-- {{$item->producto}} --}}
                                      {{-- F-producto --}}
                                    </td>
                                    <td>
                                      {{-- {{$item->cantidad_cierre}} --}}
                                    </td>
                                    <td>
                                      {{-- {{$item->bultos_ingresos}} --}}
                                      {{-- Total=F-bultos_ingresos --}}

                                    </td>
                                    <td>
                                      {{-- {{$item->cantidad_ingresos}} --}}
                                      {{-- Total=F-cantidad_ingresos --}}
                                      {{$bi}}
                                    </td>
                                    <td>
                                      {{-- {{$item->cantidad_diferencia}} --}}
                                      {{-- Total true --}}
                                      {{$ci}}
                                    </td>
                                    <td>
                                      {{$mm}}
                                      {{-- {{$item->cif_moneda_ext}} --}}
                                    </td>
                                    <td>
                                      {{-- {{$item->viu_moneda_nal}} --}}
                                    </td>
                                    <td>
                                      {{-- {{$item->cif_moneda_nal}} --}}
                                    </td>
                                    <td>
                                      {{-- {{$item->precio_compra}} --}}
                                    </td>
                                    <td>
                                      {{-- {{$item->total_compra}} --}}
                                      {{-- Total true --}}

                                    </td>
                                    <td>
                                      {{$tf}}
                                      {{-- {{$item->cif_adicional_nal}} --}}
                                    </td>
                                    <td>
                                      {{-- {{$item->cif_final_nal}} --}}
                                    </td>
                                    <td>
                                      {{-- {{$item->total_costo}} --}}
                                      {{-- total true --}}

                                    </td>
                                    <td>
                                      {{$tcf}}
                                    </td>

                                  </tr>


                                  </tbody>
                                </table>
                              </div>
                            </div>

                          </div>

                          <div class="tab-pane" id="messages">

                            <div class=" row justify-content-center align-items-center mb-3 responsive ">

                              {{-- <div class="row justify-content-center align-items-center mb-3"> --}}
                                <div class="col-4">
                                  <button type="button" class="btn-block btn btn-success">Agregar Datos de Camión</button>
                                </div>
                                <div class="col-4">
                                  <button type="button" id="create_record" class=" btn-block btn btn btn-success "  >
                                    <div class="overflow-auto">
                                      Fechas Embarque Cierre y Llegada
                                    </div></button>
                                </div>
                                <div class="col-4">
                                  <button type="button" class="btn-block btn btn-success">Forma y Fecha de Pago</button>
                                </div>
                                {{-- </div> --}}
                              {{-- <div class="table-responsive  table-hover">
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
                                        D
                                      </td>
                                      <td>
                                        E
                                      </td>
                                      <td>
                                        F
                                      </td>
                                    </tr>

                                  </tbody>
                                </table>
                              </div> --}}
                            </div>

                            <div class="row justify-content-center align-items-center mb-3 responsive">
                              <div class="col-6">
                                <button type="button" class="btn-block btn btn btn-success">Datos Reales de Embarque y Llegada</button>
                              </div>

                              <div class="col-6">
                                <button type="button" class="btn-block btn btn-success">Valor Total del Camion</button>
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
                <input type="hidden" name="action" id="action" value="Editar">
                <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Actualizar">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection
