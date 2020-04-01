@extends('layouts.dashboard')

@section('content')

      <div class="card card  card-default scrollspy">
        <div class="row" style="padding:20px">
          <div style="display: flex; justify-content: space-between">
            <div style="display: flex">
              <i class="material-icons dp48">subject</i><span class="card-title">Contenedores / Camiones - RECEPCIONADOS</span>
            </div>
          </div>
          <div class="col s12 l4" style="margin-top: 20px;">
            <div class="row">
              <form  method="post" id="buscar-camion" class="col s12">
                <div class="mb-1 col s12 l12">
                  @csrf
                  <label for="buscar-codigo-camion">Buscar camión</label>
                  <input type="hidden" name="action" id="action-buscar-camion"  value="buscar-camion-r">
                  <div class="input-group">
                    <input type="text" name="codigo" class="validate form-control browser-default " style="border-radius: 0px " id="buscar-codigo-camion" placeholder="Ingrese código camión">
                    <div class="input-group-append">
                      <button type="submit" name="actualizar" class="btn btn-50 cyan" style="border-radius: 0px !important; line-height: 45px !important; height:45px !important;width:46px !important">
                        <i class="material-icons dp48">search</i>
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
        </div>
        <div class="col s12 m12 l8" style="margin-top: 20px;">
          <div class="row ">
            <div class="col s12 l4">
              <form >
                <label for="anior">Gestión</label>
                <select class="form-control browser-default" id="anior">
                  <option>Ingresar año</option>
                  @foreach ($year as $y)
                    <option value="{{$y->TP_GESTION}}" >{{$y->TP_GESTION}}</option>
                  @endforeach
                </select>
              </form>
            </div>
            <div class="col s12 l4">
              <form>
                <label for="clasificacion">Clasificar camión </label>
                <select class="form-control browser-default" id="clasificacionr">
                </select>
              </form>
            </div>
            <div class="col s12 l4">
              <form>
                <input type="hidden" name="action" id="icamion"  value="camion-r">
                <label for="camion">Seleccionar camión </label>
                <select class="form-control browser-default" value="camion" id="camion">
                </select>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col s12">
        <div class="card card card-default scrollspy">
          <div class="row pb-4">
            <div class="col s12 l12 m12">
              <ul class="tabs">
                <li class="tab col m4"><a class="active" href="#test1">Detalle</a></li>
                {{-- <li class="tab col m3"><a href="#test2">Actualizado</a></li> --}}
                <li class="tab col m4"><span id="bloquear-camion"></span></li>
                <li class="tab col m4"><a id="camiones_vencidos" href="#test3">Camiones vencidos</a></li>
              </ul>
            </div>
            <div id="test1" class="col s12">
              <div id="responsive-table">
                <div class="card-content" style=" margin-top: -6px; overflow: auto;">
                  <div class="row">
                    <div class="col s12 dataTables_scrollBody">
                      <table class="table  centered">
                        <thead id="camiontabla-head">
                        </thead>
                        <tbody id="camiontabla">
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div id="test3" class="col s12">

              <div class="row">
                <div class="col s12 m12 l12">
                  <div id="responsive-table" class=" ">
                    <div class="card-content" style=" margin-top: -6px; overflow: auto; height: 60vh; ">
                      <h4 class="card-title"></h4>
                      <p class="mb-2"></p>
                      <div class="row">

                        <div class="col s12 dataTables_scrollBody">
                          <table id='tabla-vencidos' class="table centered responsive-table">
                            <thead>
                              <tr>
                                <th width='6%'>Codigo</th>
                                <th>Codigo auxiliar</th>
                                <th>Descripción</th>
                                <th>Fecha llegada</th>
                                <th>Fecha vencimiento</th>
                                <th>Documento zeta</th>
                                <th>Marca</th>
                                <th>Valor</th>
                                <th>Cierre</th>
                                <th>Lugar arribo</th>
                              </tr>
                            </thead>
                            <tbody id="camiones-vencidos">

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
</div>
</div>
</div>



@endsection

@section('modal')

    <div id="formModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Editar producto</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <span id="form_result"></span>
            <form  method="POST" id="sample_form" class="form-horizontal">
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
@section('after-scripts')
    <script type="text/javascript" src="{{asset('js/tabs.js')}}"></script>
@endsection
