@extends('layouts.dashboard')

@section('content')
  <div class="main-content">
    <div class="bg-gradient-primary container-fluid pb-7 pt-3">
      <p class="h1 mb-0 text-white text-uppercase d-lg-inline-block" >GESTIÓN CAMIONES</p>

        <br><br>

      <div class="row ">
            <div class="col-3 bg-gradient-secondary border ml-5 mr-1 card">
              <div class="form-group">
                {!! Form::open(['route' => ['showCamion'], 'method' => 'get', 'enctype' => 'multipart/form-data'])!!}
                @csrf
                <label for="exampleFormControlInput1">Buscar camión</label>
                <input type="text" name="codigo" class="form-control" id="exampleFormControlInput1" placeholder="Ingrese código camión">
                {{-- <br> --}}
                <button type="submit" name="actualizar" class="btn btn-primary mt-1 float-right">Buscar</button>
                {!! Form::close()!!}
              </div>
            </div>

        <div class="col-8 bg-gradient-secondary border card">
          <div class="row">
            <div class="form-group col-4">
              <label for="anio">Ingresar año</label>
              <select class="form-control" id="anio">
                @foreach ($year as $y)

                  <option value="{{$y->gestion}}" >{{$y->gestion}}</option>

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
                                          <i class="material-icons">Habilitar la venta</i>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#messages" data-toggle="tab">
                                          <i class="material-icons">Consistencia de mercancía</i>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#messages2" data-toggle="tab">
                                          <i class="material-icons">Bloqueo por camiones</i>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#messages3" data-toggle="tab">
                                          <i class="material-icons">Boqueo por ítems</i>
                                      </a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
                  <div class="card-body pt-0 ">
                      <div class="tab-content text-center">
                          <div class="tab-pane active" id="profile">

                            <div class="row">
                              <div class="table-responsive table-dark table-hover">
                                <table  class="table align-items-center table-flush">
                                  <thead>
                                    <tr>
                                      <th scope="col">Camión</th>
                                      <th scope="col">Estado</th>
                                      <th scope="col">Usuario de ingreso</th>
                                      <th scope="col">Fecha de ingreso</th>
                                      <th scope="col">Salida</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                @if ( $datos !="null" )

                                  @foreach ($datos as $item)
                                    <tr>
                                      <td>
                                        {{$item->camion}}
                                      </td>
                                      <td>
                                        {{$item->estado}}
                                      </td>
                                      <td>
                                        {{$item->usuario_ingreo}}
                                      </td>
                                      <td>
                                        {{$item->fecha_ingreso}}
                                      </td>
                                      <td>
                                        {{$item->usuario_salida}}
                                      </td>
                                    </tr>

                                  @endforeach
                                @endif

                                  </tbody>
                                </table>
                              </div>
                            </div>

                          </div>

                          <div class="tab-pane" id="messages">

                            <div class="row">
                              <div class="table-responsive table-dark table-hover">
                                <table  class="table align-items-center table-flush">
                                  <thead>
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
                          <div class="table-responsive table-dark table-hover">
                            <table  class="table align-items-center table-flush">
                              <thead>
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
                      <div class="table-responsive table-dark table-hover">
                        <table  class="table align-items-center table-flush">
                          <thead>
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
