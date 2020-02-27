@extends('layouts.dashboard')

@section('content')
  <div class=" ">
    <div class="card card card card-default scrollspy">
      <div class="card-content">
        <h4><span class="card-title">Retiros Bancos/Prosegur</span></h4>
        <div class="row">
          <div class="col s12">
            <ul class="tabs">
              <li class="tab col m3"><a class='active' href="#test1">Salida Bancos</a></li>
              <li class="tab col m3"><a class="" href="#test2">Otros Depósitos</a></li>
              <li class="tab col m4"><a class="" href="#test3">Depósitos Pendientes</a></li>
            </ul>
            <div id="test1">
              <div class="container" style="margin-top: 30px">
                <div class=" " data-example-id="form-group-height-sizes">

                  <div class="col l5 m5 s5">
                    <div class="form-group">
                      <label for="" class="form-control-babel">Desde</label>
                      <input type="date" id="desde1" class="form-control browser-default">
                    </div>
                  </div>
                  <div class="col l5 m5 s5">
                    <div class="form-group">
                      <label for="" class="form-control-babel">Hasta</label>
                      <input type="date" id="hasta1" class="form-control browser-default">
                    </div>
                  </div>
                  <div class="col l2 m2 s2">
                    <button type="button" id="buscar-salida-bancos" class="btn cyan btn-45" style='margin-top:21px' name="button">Buscar</button>
                  </div>
                </div>
                 <div class=" ">
                    <div class="col l12 m12 s12" style="margin-top: 20px;">
                      <div style="display: flex;justify-content: space-between">
                          <div style="display: flex;">
                            <i class="material-icons dp48">subject</i>
                            <span class="card-title">Detalle Retiro Prosegur</span>
                          </div>
                          <a class="btn btn-50 cyan  float-right" >
                            <i class="material-icons" id="agregar-retiro-indice">add_box</i>
                          </a>

                      </div>
                      <table id='tableRetiroProsegur' class="table responsive-table">
                        <thead>
                          <tr>
                            <th width='6%'>ID</th>
                            <th>Tipo Retiro</th>
                            <th>Desde</th>
                            <th>Hasta</th>
                            <th>Cantidad</th>
                            <th>Monto total</th>
                            <th>Estado</th>
                            <th>Fecha cierre</th>
                            <th>Responsable</th>
                            <th>Observacion</th>
                          </tr>
                        </thead>
                        <tbody id="retiroTabla">

                        </tbody>
                      </table>
                     </div>

                     <div class="col m12" style="margin-top: 20px;">

                       <span id="icono0">
                            <h6>Ingrese el numero de deposito que desea agregar al Prosegur</h6>
                            <br>
                            <div class="form-group col l12 m12 s12">
                              <label for="" class="form-control-label">Nro. de Deposito</label>
                              <textarea  id="insertar-migracion" rows='6'  class="form-control-textarea browser-default" style="width:100%" name="txt_migracion">
                              </textarea>
                            </div>
                       </span>
                       <span id="icono1"></span>

                           <table id="table-detalle" class="responsive-table striped">
                             <thead id="depositoDetalleHead">

                             </thead>
                             <tbody id="depositoDetalleTabla">

                             </tbody>
                           </table>

                      </div>
                </div>
              </div>
            </div>
            <div id="test2" class="col s12  lighten-4">
              <div class="container" style="margin-top: 30px">
                <div class=" " data-example-id="form-group-height-sizes">

                  <div class="col l5 m5 s5">
                    <div class="form-group">
                      <label for="" class="form-control-babel">Desde</label>
                      <input type="date" id="desde2" class="form-control browser-default">
                    </div>
                  </div>
                  <div class="col l5 m5 s5">
                    <div class="form-group">
                      <label for="" class="form-control-babel">Hasta</label>
                      <input type="date" id="hasta2" class="form-control browser-default">
                    </div>
                  </div>
                  <div class="col l2 m2 s2">
                    <button type="button" id="buscar-otros-depositos" class="btn cyan btn-45" style='margin-top:21px' name="button">Buscar</button>
                  </div>
                </div>

                <div class="row">
                  <div class="col s12">
                  </div>
                  <div class="col s12 dataTables_scrollBody">


                            <div class="col m12" style="margin-top: 20px;">
                              <div style="display: flex">
                                <i class="material-icons dp48">subject</i><span class="card-title">Detalle otros retiros prosegur</span>
                                <a class="btn-floating cyan mb-1 float-right" >
                                  <i class="material-icons" id="agregar-otro-retiro">add</i>
                                </a>
                              </div>
                              <table class=" table responsive-table centered striped">
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
            <div id="test3" class="col s12  lighten-4">
              <div class="container" style="margin-top: 30px">
                <div class=" " data-example-id="form-group-height-sizes">

                  <div class="col l5 m5 s5">
                    <div class="form-group">
                      <label for="" class="form-control-babel">Desde</label>
                      <input type="date" id="desde3" class="form-control browser-default">
                    </div>
                  </div>
                  <div class="col l5 m5 s5">
                    <div class="form-group">
                      <label for="" class="form-control-babel">Hasta</label>
                      <input type="date" id="hasta3" class="form-control browser-default">
                    </div>
                  </div>
                  <div class="col l2 m2 s2">
                    <button type="button" id="buscar-depositos-pendientes" class="btn cyan btn-45" style='margin-top:21px' name="button">Buscar</button>
                  </div>
                </div>

                <div class="row">
                  <div class="col s12">
                  </div>
                  <div class="col s12 dataTables_scrollBody">


                            <div class="col m12" style="margin-top: 20px;">
                              <div style="display: flex">
                                <i class="material-icons dp48">subject</i><span class="card-title">Detalle depósitos pendientes</span>
                              </div>
                              <table class=" table responsive-table centered striped">
                              <thead>
                                <tr>
                                  <th  width='6%'>Folio</th>
                                  <th>Monto</th>
                                  <th>Fecha caja</th>
                                  <th>Operación</th>
                                  <th>Tipo de cheque</th>
                                  <th>Deposito</th>
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
  </div>

@endsection

@section('js')
  <script src="{{ asset('js/contabilidad.js') }}"></script>
@endsection
