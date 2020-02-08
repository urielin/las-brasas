@extends('layouts.dashboard')

@section('content')
<div class="main-content">
  <div class=" container pb-3 pt-3">
    <h4>ACTUALIZAR TIPO DE CAMBIO</h4>

    <div class="container">
      @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <h4>ACTUALIZAR TIPO DE CAMBIO</h4>
            <p>{{ $message }}</p>
        </div>
      @endif

      @if ($errors->any())
        <div class="card-alert card red">
          @foreach ($errors->all() as  $error)
            <div class="card-content white-text">
                <li>{{ $error }}</li>
            </div>
            <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
            </button>
          @endforeach
        </div>
      @endif
    </div>

    <div class="row">
      <div class="col s12">
        <div class="card card card-default scrollspy">
            <div class="row pb-4">
                    <div class="col s12">
                      <ul class="tabs">
                        <li class="tab col m6"><a href="#test1">Seleccione el periodo a verificar</a></li>
                        <li class="tab col m6"><a class="active" href="#test2">Actualizar un mes completo de la gestión actual</a></li>
                      </ul>
                    </div>

                    <div id="test1" class="col s12">
                      {!! Form::open(['route' => ['showCambio'], 'method' => 'get', 'enctype' => 'multipart/form-data'])!!}
                                    @csrf
                                <div class="row">
                                  <div class="col l4">
                                    <label class="h4 mb-0 text-black d-lg-inline-block" for="sel1">Seleccionar periodo</label>
                                    <input class="form-control" name="Mes_cambiar" class="form-control" type="month"  >
                                  </div>
                                  <div class="col l4 pt-3">
                                    <button type="submit" name="buscar" class="btn btn-primary responsive">Buscar mes</button>
                                  </div>
                                  <div class="col l4">
                                  </div>
                                </div>
                      {!! Form::close()!!}
                    </div>
                    <div id="test2" class="col s12">

                          {!! Form::open(['route' => ['updateCambio'], 'method' => 'put', 'enctype' => 'multipart/form-data'])!!}
                              @csrf


                            <div class="row">
                              <div class="col l4">
                                <label class="h4 mb-0 text-black d-lg-inline-block" for="sel1">Tipo de cambio</label>
                                <input type="text" name="Tipo_de_cambio" placeholder="Ingresar nuevo tipo de cambio" class="form-control" id="usr">
                              </div>

                              <div class="col l4 ">
                                <label class="h4 mb-0 text-black d-lg-inline-block" for="sel1">Mes cambiar</label> <br>
                                <input class="form-control" name="Mes_cambiar" class="form-control" type="month"  >
                              </div>

                              <div class="col l2 pt-3 pb--4">
                                <button type="submit" name="actualizar" class="btn btn-primary">Actualizar mes seleccionado</button>
                              </div>
                          </div>
                        {!! Form::close()!!}
                    </div>
            </div>
          </div>
        </div>
      </div>
        {{-- -------------------------------------- --}}
        <div class="row">
          <div class="col s12">
            <div class="card card card-default scrollspy">
                <div class="card-content">
                  <div class="card-title">
                    <div class="row">
                      <div class="col s12 m6 l10">
                        <h4 class="card-title">Tipo de cambio mensual</h4>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col s12">
                      <table class="bordered responsive-table">
                                  <thead>
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
</div>
@endsection
