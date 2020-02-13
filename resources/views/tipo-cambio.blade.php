@extends('layouts.dashboard')

@section('content')
<div class="main-content">
  <div class=" container pb-3 pt-3">

    <div class="container">
      @if ($message = Session::get('success'))
        <div class="card-alert card green">
          <div class="card-content white-text">
                    <p>{{ $message }}</p>
          </div>

        </div>
      @endif

      @if ($errors->any())
        <div class="card-alert card red">
          @foreach ($errors->all() as  $error)
            <div class="card-content white-text">
                <li>{{ $error }}</li>
            </div>

          @endforeach
        </div>
      @endif
    </div>

      <div class="row">
        <div class="col s12">
          <div class="card card card-default scrollspy">
              <div class="card-content">
                <div style="display: flex">
                  <i class="material-icons dp48">subject</i><span class="card-title">Actualizar tipo de cambio  </span>
                </div>

                  <div class="row pb-4">
                    <div class="col s12">
                      <ul class="tabs">
                        <li class="tab col m6"><a class="active" href="#test1">Seleccione el periodo a verificar</a></li>
                        <li class="tab col m6"><a href="#test2">Actualizar un mes completo de la gestión actual</a></li>
                      </ul>
                    </div>
                    <div id="test1" class="col s12">
                      <div class="container" style="margin-top: 30px">
                        {!! Form::open(['route' => ['showCambio'], 'method' => 'get', 'enctype' => 'multipart/form-data'])!!}
                        @csrf
                        <div class="row">
                          <div class="col l4">
                            <label class="h4 mb-0 text-black d-lg-inline-block" for="sel1">Seleccionar periodo</label>
                            <input class="form-control browser-default" name="Mes_cambiar" class="form-control" type="month"  >
                          </div>
                          <div class="col l4  ">
                            <button type="submit" name="buscar" class="btn cyan btn-45" style="margin-top: 21px">Buscar Mes</button>
                          </div>
                          <div class="col l4">
                          </div>
                        </div>
                        {!! Form::close()!!}
                      </div>
                    </div>
                    <div id="test2" class="col s12">
                      <div class="container" style="margin-top: 30px">

                        {!! Form::open(['route' => ['updateCambio'], 'method' => 'put', 'enctype' => 'multipart/form-data'])!!}
                        @csrf
                        <div class="row">
                          <div class="col l2">
                            <label class="h4 mb-0 text-black d-lg-inline-block" for="sel1">Tipo de cambio</label>
                            <input type="text" name="Tipo_de_cambio" placeholder="tipo de cambio" class="form-control browser-default" id="usr">
                          </div>

                          <div class="col l4 ">
                            <label class="h4 mb-0 text-black d-lg-inline-block" for="sel1">Mes cambiar</label> <br>
                            <input class="form-control" name="Mes_cambiar" class="form-control" type="month"  >
                          </div>

                          <div class="col l2 ">
                            <button type="submit" name="actualizar" class="btn btn-45 cyan" style="margin-top: 21px;width:200px !important">Actualizar Mes</button>
                          </div>
                        </div>
                        {!! Form::close()!!}
                        </div>
                    </div>
                  </div>


              </div>

          </div>
        </div>
      </div>


        <div class="row">
          <div class="col s12">
            <div class="card card card-default scrollspy">
                <div class="card-content">
                  <div class="card-title">
                    <div class="row">
                      <div class="col s12 m6 l10">
                        <div style="display: flex">
                          <i class="material-icons dp48">subject</i><span class="card-title">Tipo de cambio mensual</span>
                        </div>
                       </div>
                    </div>
                  </div>

                   <div class="" style=" margin-top: -6px; overflow: auto; height: 60vh; ">
                       <table class="table striped centered">
                          <thead class="thead-light" id="camiontabla-head">
                            <tr>
                              <th >Fecha</th>
                              <th >Cambio</th>
                              <th >USUARIO</th>
                            </tr>
                          </thead>

                          <tbody>
                              @foreach($TipoCambio as $item)
                                <tr>
                                  <td >
                                    {{$item->CAMB_FECHA}}
                                  </td>
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
</div>
@endsection
