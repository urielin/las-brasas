@extends('layouts.dashboard')
@section('content')
    <div class="card card card card-default scrollspy">
      <div class="card-content">
        <div class="row" style="margin-left:-15px">
          <div class="col l12 m12 s12">
            <div style="display: flex;justify-content: space-between">
              <div style="display: flex;">
                <i class="material-icons dp48">subject</i>
                <span class="card-title" style="font-size:16px; line-height: 20px;">Retiros Bancos/Prosegur</span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
            <ul class="tabs">
              <li class="active tab col m3"><a href="#test1">Salida Bancos</a></li>
              <li class="tab col m3"><a href="#test2">Otros Depósitos</a></li>
              <li class="tab col m4"><a  href="#test3">Depósitos Pendientes</a></li>
            </ul>

            <div id="test1">
              <div class="container" style="margin-top: 15px">
                <div class="row ml-1">
                  <div class="col l3 m3 s12">
                    <div class="form-group">
                      <label for="" class="form-control-babel">Desde</label>
                      <input type="date" id="desde1"  class="form-control browser-default">
                    </div>
                  </div>
                  <div class="col l3 m3 s12">
                    <div class="form-group">
                      <label for="" class="form-control-babel">Hasta</label>
                      <input type="date" id="hasta1"  class="form-control browser-default">
                    </div>
                  </div>
                  <div class="col l2 m2 s12">
                    <button type="button" id="buscar-salida-bancos" class="btn cyan btn-45 col s12" style='margin-top:21px' name="button">Buscar</button>
                  </div>
                  <div class="col l4 m4 s12">

                  </div>
                </div>

                <div class="row ">
                  <div class="col l12 m12 s12" style="margin-top: 20px;">
                    <div style="display: flex;justify-content: space-between">
                      <div style="display: flex;">
                        <i class="material-icons dp48">subject</i>
                        <span class="card-title" style="font-size:16px; line-height: 20px;">Detalle Retiro Prosegur</span>
                      </div>
                      <a class="btn btn-50 green float-right">
                        <i class="material-icons" id="agregar-retiro-indice">add_box</i>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="row" style="margin-top: 20px;">
                  <div id="responsive-table" class="col l12 m12 s12" class="pt-1">
                    <div style=" margin-top: -6px; overflow: auto; height: 60vh;">
                      <div class="row">
                        <div class="col s12 dataTables_scrollBody">
                          <table id='tableRetiroProsegur' class="table centered ">
                            <thead>
                              <tr>
                                <th width='6%'>ID</th>
                                <th>Tipo Retiro</th>
                                <th>Desde</th>
                                <th>Hasta</th>
                                <th>Estado</th>
                                <th>Fecha cierre</th>
                                <th>Responsable</th>
                                <th>Observacion</th>
                                <th>Cantidad</th>
                                <th>Monto total</th>
                                <th>Acción</th>
                              </tr>
                            </thead>
                            <tbody id="retiroTabla">

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row" style="margin-top: 20px;">
                  <div class="col l12 m12 s12">
                    <span id="icono0"></span>
                  </div>
                </div>
                <div class="row" >
                  <div class="col l12 m12 s12">
                    <span id="icono1"></span>
                  </div>
                </div>

                <div class="row">
                  <div id="responsive-table" class="col l12 m12 s12 centered" class="pt-1">
                    <div style=" margin-top: -6px; overflow: auto; height: 60vh;">
                      <div class="row">
                        <div class=" dataTables_scrollBody">
                          <table id="table-detalle" class="table ">
                            <thead id="depositoDetalleHead">

                            </thead>
                            <tbody id="depositoDetalleTabla">

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


              </div>
            </div>
            <div id="test2">
              <div class="container" style="margin-top: 15px">
                <div class="row ml-1">
                  <div class="col l3 m3 s12">
                    <div class="form-group">
                      <label for="" class="form-control-babel">Desde</label>
                      <input type="date" id="desde2" class="form-control browser-default">
                    </div>
                  </div>
                  <div class="col l3 m3 s12">
                    <div class="form-group">
                      <label for="" class="form-control-babel">Hasta</label>
                      <input type="date" id="hasta2" class="form-control browser-default">
                    </div>
                  </div>
                  <div class="col l2 m2 s12">
                    <button type="button" id="buscar-otros-depositos" class="btn cyan btn-45 col s12" style='margin-top:21px' name="button">Buscar</button>
                  </div>
                  <div class="col l4 m4 s12">

                  </div>
                </div>

                <div class="row">
                  <div class="col l12 m12 s12" style="margin-top: 20px;">
                    <div style="display: flex;justify-content: space-between">
                      <div style="display: flex;">
                        <i class="material-icons dp48">subject</i>
                        <span class="card-title" style="font-size:16px">Detalle otros retiros prosegur</span>
                      </div>
                      <a class="btn-50 btn green float-right" >
                        <i class="material-icons" id="agregar-otro-retiro">add_box</i>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="row" style="margin-top: 20px;">
                  <div id="responsive-table" class="col l12 m12 s12" class="pt-1">
                    <div style=" margin-top: -6px; overflow: auto; height: 60vh;">
                      <div class="row">
                        <div class="col s12 dataTables_scrollBody">
                          <table class=" table">
                            <thead>
                              <tr>
                                <th width='6%'>Folio</th>
                                <th>Fecha</th>
                                <th>Descripcion</th>
                                <th>Sucursal</th>
                                <th>Operación</th>
                                <th>Usuario</th>
                                <th>Deposito</th>
                                <th>Monto</th>
                              </tr>
                            </thead>
                            <tbody id="otroRetiroTabla">

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


              </div>
            </div>

            <div id="test3">
              <div class="container" style="margin-top: 15px">
                <div class="row ml-1">
                  <div class="col l3 m3 s12">
                    <div class="form-group">
                      <label for="" class="form-control-babel">Desde</label>
                      <input type="date" id="desde3" class="form-control browser-default">
                    </div>
                  </div>
                  <div class="col l3 m3 s12">
                    <div class="form-group">
                      <label for="" class="form-control-babel">Hasta</label>
                      <input type="date" id="hasta3" class="form-control browser-default">
                    </div>
                  </div>
                  <div class="col l2 m12 s12">
                    <button type="button" id="buscar-depositos-pendientes" class="btn cyan btn-45 col s12" style='margin-top:21px' name="button">Buscar</button>
                  </div>
                  <div class="col l4 m4 s12">
                  </div>
                </div>

                <div class="row">
                  <div class="col l12 m12 s12" style="margin-top: 20px;">
                    <div style="display: flex;justify-content: space-between">
                      <div style="display: flex;">
                        <i class="material-icons dp48">subject</i>
                        <span class="card-title" style="font-size:16px">Detalle depósitos pendientes</span>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="row" style="margin-top: 20px;">
                  <div id="responsive-table">
                    <div style=" margin-top: -6px; overflow: auto; height: 60vh;">
                        <div class="col s12 dataTables_scrollBody">
                          <table class=" table">
                            <thead>
                              <tr>
                                <th>Folio</th>
                                <th>Fecha caja</th>
                                <th>Operación</th>
                                <th>Tipo de cheque</th>
                                <th>Deposito</th>
                                <th>Monto</th>
                              </tr>
                            </thead>
                            <tbody id="retiroPendienteTabla">
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
@endsection

@section('js')
  <script src="{{ asset('js/contabilidad.js') }}"></script>
@endsection
