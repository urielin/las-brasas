@extends('layouts.dashboard')

@section('content')

  <div class="main-content">
    <div class="bg-gradient-primary container-fluid pb-7 pt-3">
      <p class="h1 my-3 text-white text-uppercase d-lg-inline-block" >GESTIÓN CAMIONES</p>

        <br><br>

      <div class="row ">
            <div class="col-4 bg-gradient-secondary border ml-3 mr-1 pt-3 card">
              <div class="form-group">
                {!! Form::open(['route' => ['showCamion'],'class' => 'text-center', 'method' => 'get', 'enctype' => 'multipart/form-data'])!!}
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
            <div class="form-group col-4">
              <label for="anio">Ingresar año</label>
              <select class="form-control" id="anio">
                @foreach ($year as $y)

                  <option value="{{$y->fecha_llegada}}" >{{$y->fecha_llegada}}</option>

                @endforeach
              </select>
            </div>

            <div class="form-group col-8">
              <label for="camion">Seleccionar camión </label>
              <select class="form-control" id="camion">

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
                                          <i style=" font-style: normal; " class="material-icons">Consistencia de mercancía</i>
                                      </a>
                                  </li>
                                  <!-- <li class="nav-item">
                                      <a class="nav-link" href="#messages" data-toggle="tab">
                                          <i style=" font-style: normal; " class="material-icons">Consistencia de mercancía</i>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#messages2" data-toggle="tab">
                                          <i style=" font-style: normal; " class="material-icons">Bloqueo por camiones</i>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#messages3" data-toggle="tab">
                                          <i style=" font-style: normal; " class="material-icons">Boqueo por ítems</i>
                                      </a>
                                  </li> -->
                              </ul>
                          </div>
                      </div>
                  </div>
                  <div class="card-body pt-0 ">
                      <div class="tab-content text-center">
                          <div class="tab-pane active" id="profile">

                            <div class="table">
                              <thead>
                                <tr>

                            </div>
                            <div class="row">
                              <div class="table-responsive table-hover">
                                <table  class="table align-items-center table-flush">
                                  <thead class="thead-light">
                                    <tr>
                                      <th scope="col">Habilitar</th>
                                      <th scope="col">Camión</th>
                                      <th scope="col">Descripcion</th>
                                      <th scope="col">Cantidad</th>
                                      <th scope="col">Moneda</th>
                                      <th scope="col">Costo</th>
                                      

                                  </thead>
                                  <tbody id="camiontabla">
                                    {{-- <tr><td>asdasd</td></tr> --}}



                                  @foreach ($datos as $item)
                                    <tr >
                                      <td>
                                        {{$item->codigo}}
                                      </td>
                                      <td>
                                        {{$item->descripcion}}
                                      </td>
                                      <td>
                                        {{$item->cierre_cantidad}}
                                      </td>
                                      <td>
                                        {{$item->monto_cierre}}
                                      </td>
                                      <td>
                                        {{$item->ingreso_cantidad}}
                                      </td>
                                      <td>
                                      <label class="custom-toggle custom-toggle-default">
                                        <input type="checkbox" checked="">
                                        <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span>
                                      </label>
                                      </td>
                                    </tr>

                                  @endforeach


                                  </tbody>
                                </table>
                              </div>
                            </div>

                          </div>

                          <div class="tab-pane" id="messages">

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

                  <div class="tab-pane" id="messages3">

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
                                J
                              </td>
                              <td>
                                K
                              </td>
                              <td>
                                L
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
