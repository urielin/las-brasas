@extends('layouts.dashboard')

@section('content')

  {{-- <div class="main-content ">
    <div class=""> --}}
<div class="main-content">
  <div class="bg-gradient-primary container-fluid pb-7 pt-3">
    <p class="h1 mb-0 text-white text-uppercase d-lg-inline-block" >ACTUALIZAR TIPO DE CAMBIO</p>
    <div class="container">
      @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
      @endif

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as  $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
    </div>
    <div class="container">

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
                                            <i class="material-icons">Seleccione el periodo a verificar</i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#messages" data-toggle="tab">
                                            <i class="material-icons">Actualizar un mes completo de la gestión actual</i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0 ">
                        <div class="tab-content text-center">
                            <div class="tab-pane active" id="profile">


                                {{-- <div class="row">
                                  <div class="col-6">
                                    <label class="h4 mb-0 text-black d-lg-inline-block" for="sel1">Año</label>
                                    <select class="form-control" id="sel1">
                                      <option>2011</option>
                                      <option>2012</option>
                                      <option>2013</option>
                                      <option>2014</option>
                                      <option>2015</option>
                                      <option>2016</option>
                                      <option>2017</option>
                                      <option>2018</option>
                                      <option>2019</option>
                                      <option>2020</option>
                                    </select>
                                  </div>

                                  <div class="col-6">
                                    <label class="h4 mb-0 text-black d-lg-inline-block" for="sel1">Mes</label>
                                    <select class="form-control" id="sel1">
                                      <option>ENERO</option>
                                      <option>FEBRERO</option>
                                      <option>MARZO</option>
                                      <option>ABRIL</option>
                                      <option>MAYO</option>
                                      <option>JUNIO</option>
                                      <option>JULIO</option>
                                      <option>AGOSTO</option>
                                      <option>SEPTIEMBRE</option>
                                      <option>OCTUBRE</option>
                                      <option>NOVIEMBRE</option>
                                      <option>DICIEMBRE</option>
                                    </select>
                                  </div>
                                </div> --}}

                                {!! Form::open(['route' => ['showCambio'], 'method' => 'get', 'enctype' => 'multipart/form-data'])!!}
                                    @csrf

                                <div class="row">
                                  <div class="col-4">
                                    <label class="h4 mb-0 text-black d-lg-inline-block" for="sel1">Seleccionar periodo</label>
                                    {{-- <input type="datetime" name="Mes_cambiar" class="form-control" id="usr"> --}}

                                    <input type="date" name="Mes_cambiar" value="date('YYYYMMDD',strtotime($yourPassedVariableToView))}}">
                                    {{-- <input type="datetime-local" name="date_end" value="date('Y-m-d\TH:i',strtotime($yourPassedVariableToView))}}"> --}}
                                  </div>
                                  <div class="col4">

                                    <button type="submit" name="buscar" class="btn btn-primary responsive">Buscar mes</button>
                                  </div>
                                  <div class="col-6 pt-4 pb--4">
                                  </div>
                                </div>
                                {!! Form::close()!!}

                            </div>

                            <div class="tab-pane" id="messages">

                              {!! Form::open(['route' => ['updateCambio'], 'method' => 'put', 'enctype' => 'multipart/form-data'])!!}
                                  @csrf


                                <div class="row">
                                  <div class="col-4">
                                    <label class="h4 mb-0 text-black d-lg-inline-block" for="sel1">Tipo de cambio</label>
                                    <input type="text" name="Tipo_de_cambio" class="form-control" id="usr">
                                  </div>

                                  <div class="col-4">
                                    <label class="h4 mb-0 text-black d-lg-inline-block" for="sel1">Mes cambiar</label>
                                    {{-- <input type="datetime" name="Mes_cambiar" class="form-control" id="usr"> --}}
                                    <input type="date" name="Mes_cambiar" value="date('YYYYMMDD',strtotime($yourPassedVariableToView))}}">
                                    {{-- <input type="datetime-local" name="date_end" value="date('Y-m-d\TH:i',strtotime($yourPassedVariableToView))}}"> --}}
                                  </div>
                                  <div class="col-2 pt-4 pb--4">
                                    <button type="submit" name="actualizar" class="btn btn-primary">Actualizar mes seleccionado</button>
                                  </div>
                              </div>
                            {!! Form::close()!!}

                        </div>
                    </div>
                  </div>
                <!-- End Tabs with icons on Card -->

            </div>

        </div>
    </div>






  <div class="row ">
  <div class="col-xl-12 mb-5 mb-xl-0">
      <div class="card shadow mt-3">
        <div class="card-header border-0  ">
          <div class="row align-items-center">
            <div class="col-12 ">
                <div class="row">
                  <div class="col-12 media">
                    <h1 class="mb--4 mt--3 media" >Tipo de cambio mensual</h2>
                  </div>
                </div>
            </div>
          </div>
        </div>
        <div class="table-responsive table-dark table-hover">

          <!-- Projects table -->
          <table  class="table align-items-center table-flush">
            <thead>
              <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Cambio</th>
                <th scope="col">USUARIO</th>
              </tr>
            </thead>
            <tbody>
              @foreach($TipoCambio as $item)
                <tr>
                  <th scope="row">
                    {{$item->CAMB_FECHA}}
                  </th>
                  <td>
                    {{$item->CAMB_CAMBIO}}
                  </td>
                  <td>
                   {{$item->CAMB_USUARIO}}
                  </td>


                </tr>
              @endforeach

            </tbody>
          </table>
        </div>

      </div>
    </div>

  </div>
  <!-- Footer -->

    </div>
  </div>
</div>



@endsection
