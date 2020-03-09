@extends('layouts.dashboard')

@section('content')
  <div class=" ">
    <div class="card card card card-default scrollspy">
      <div class="card-content">
        <h4><span class="card-title">GESTIÓN DE CAMIONES Y CARGA</span></h4>

            <div class="card card card-default scrollspy">
              <div class="row" style="padding:20px">
                <div class="col s12 l3" style="margin-top: 20px;">
                      <div class="">
                        <div class="row">
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
                      </div>
                </div>

                <div class="col s12 l9" style="margin-top: 20px;">
                  <div class="row">

                    <div class="row ">
                      <form class="col s12">
                        <div class="row">

                          <div class="col s12 l6">
                              <label for="clasificacion" >Clasificación</label>
                              <select class="form-control browser-default" id="clasificacionad">
                                <option value="0">Ingrese la clasificación</option>
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
                      </form>
                    </div>
                  </div>
              </div>
            </div>
          </div>

            <div class="row">
              <div class="col s12">
                <div class="card card card-default scrollspy">

                  <table class="responsive-table centered">
                    <thead>
                    <tr>
                      <th>Id</th>
                      <th>Código</th>
                      <th>Estado</th>
                      <th>Código cierre</th>
                      <th>Descripción</th>
                      <th>Fecha cierre</th>
                      <th>Proveedor</th>
                      <th>Monto cierre</th>
                      <th>Moneda</th>
                      <th>Embarque</th>
                      <th>Llegada estimada</th>
                      <th>Lugar llegada</th>
                      <th>Origen</th>
                      <th>Documento</th>
                      <th>Empresa transporte</th>
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
  </div>
@endsection

@section('js')
  <script src="{{ asset('js/gestionAdministracion.js') }}"></script>
@endsection
