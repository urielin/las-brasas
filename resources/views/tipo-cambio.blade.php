@extends('layouts.dashboard')

@section('content')

  {{-- <div class="main-content ">
    <div class=""> --}}
<div class="main-content">
  <div class=" container pb-7 pt-3">
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
                <div class="card card-nav-tabs mb-1">
                    <div class="card-header card-header-primary">
                        <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                        <div class="nav-tabs-navigation ">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active " href="#profile" data-toggle="tab">
                                            Seleccione el periodo a verificar
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#messages" data-toggle="tab">
                                            Actualizar un mes completo de la gestión actual
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0 ">
                        <div class="tab-content text-center">
                            <div class="tab-pane active" id="profile">
                                {!! Form::open(['route' => ['showCambio'], 'method' => 'get', 'enctype' => 'multipart/form-data'])!!}
                                    @csrf
                                <div class="row">
                                  <div class="col l4">
                                    <label class="h4 mb-0 text-black d-lg-inline-block" for="sel1">Seleccionar periodo</label>
                                    <input class="form-control" name="Mes_cambiar" class="form-control" type="month" value="date('YYYYMMDD',strtotime($yourPassedVariableToView))}}" >
                                  </div>
                                  <div class="col l4 pt-3">
                                    <button type="submit" name="buscar" class="btn btn-primary responsive">Buscar mes</button>
                                  </div>
                                  <div class="col l4 pt-4 pb--4">
                                  </div>
                                </div>
                                {!! Form::close()!!}
                            </div>

                            <div class="tab-pane" id="messages">

                              {!! Form::open(['route' => ['updateCambio'], 'method' => 'put', 'enctype' => 'multipart/form-data'])!!}
                                  @csrf


                                <div class="row">
                                  <div class="col l4">
                                    <label class="h4 mb-0 text-black d-lg-inline-block" for="sel1">Tipo de cambio</label>

                                    <input type="text" name="Tipo_de_cambio" placeholder="Ingresar nuevo tipo de cambio" class="form-control" id="usr">


                                  </div>

                                  <div class="col l4 ">
                                    <label class="h4 mb-0 text-black d-lg-inline-block" for="sel1">Mes cambiar</label> <br>
                                    {{-- <input type="datetime" name="Mes_cambiar" class="form-control" id="usr"> --}}

                                    {{-- <input type="date" name="Mes_cambiar" class="form-control" value="date('YYYYMMDD',strtotime($yourPassedVariableToView))}}"> --}}
                                    <input class="form-control" name="Mes_cambiar" class="form-control" type="month" value="date('YYYYMMDD',strtotime($yourPassedVariableToView))}}" >


                                    {{-- <input type="datetime-local" name="date_end" value="date('Y-m-d\TH:i',strtotime($yourPassedVariableToView))}}"> --}}
                                  </div>
                                  <div class="col l2 pt-3 pb--4">
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







  <!-- Footer -->

    </div>

  </div>
  <div class="container-fluid mt--7">
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
        <div class="table-responsive table-hover">

          <!-- Projects table -->
          <table  class="table align-items-center table-flush">
            <thead class="thead-light">
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

  </div>
</div>



@endsection
