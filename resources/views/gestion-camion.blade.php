@extends('layouts.dashboard')

@section('content')
  <div class="main-content">
    <div class="bg-gradient-primary container-fluid pb-7 pt-3">
      <p class="h1 mb-0 text-white text-uppercase d-lg-inline-block" >GESTIÓN CAMIONES</p>

        <br><br>

      <div class="row ">
            <div class="col-3 bg-gradient-secondary border ml-5 mr-1">
              <div class="form-group">
                {!! Form::open(['route' => ['showCamion'], 'method' => 'get', 'enctype' => 'multipart/form-data'])!!}
                @csrf
                <label for="exampleFormControlInput1">Buscar camión</label>
                <input type="text" name="Código" class="form-control" id="exampleFormControlInput1" placeholder="Ingrese código camión">
                {{-- <br> --}}
                <button type="submit" name="actualizar" class="btn btn-primary mt-1 float-right">Buscar</button>
                {!! Form::close()!!}
              </div>
            </div>

        <div class="col-8 bg-gradient-secondary border ">
          <div class="row">
            <div class="form-group col-4">
              <label for="exampleFormControlSelect1">Ingresar año</label>
              <select class="form-control" id="exampleFormControlSelect1">
                <option>2020</option>
                <option>2019</option>
                <option>2018</option>
                <option>2017</option>
                <option>2016</option>
              </select>
            </div>

            <div class="form-group col-8">
              <label for="exampleFormControlSelect2">Seleccionar camión </label>
              <select class="form-control" id="exampleFormControlSelect2">
                <option>17PO20</option>
                <option>17PO21</option>
                <option>17PO22</option>
                <option>17PO23</option>
                <option>17PO24</option>
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
                                      <th scope="col">Fecha</th>
                                      <th scope="col">Cambio</th>
                                      <th scope="col">USUARIO</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    <tr>
                                      <td>
                                        A
                                      </td>
                                      <td>
                                        B
                                      </td>
                                      <td>
                                        C
                                      </td>
                                    </tr>

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
